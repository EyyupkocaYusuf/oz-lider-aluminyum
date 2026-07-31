<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class OptimizeSiteImages extends Command
{
    protected $signature = 'images:optimize
                            {--width=1920 : Maksimum genişlik (piksel)}
                            {--quality=80 : JPEG kalitesi}
                            {--path=images : public/ altındaki hedef klasör}';

    protected $description = 'public/ altındaki JPEG görselleri yeniden boyutlandırıp sıkıştırır (sayfa hızı / SEO).';

    public function handle(): int
    {
        if (! extension_loaded('gd')) {
            $this->error('PHP GD eklentisi etkin değil.');

            return self::FAILURE;
        }

        $directory = public_path($this->option('path'));

        if (! is_dir($directory)) {
            $this->error("Klasör bulunamadı: {$directory}");

            return self::FAILURE;
        }

        $maxWidth = (int) $this->option('width');
        $quality = (int) $this->option('quality');

        $files = Finder::create()->files()->in($directory)->name('/\.(jpe?g)$/i');
        $savedBytes = 0;
        $processed = 0;

        foreach ($files as $file) {
            $path = $file->getRealPath();
            $before = filesize($path);

            $image = @imagecreatefromjpeg($path);

            if ($image === false) {
                $this->warn("Atlandı (okunamadı): {$file->getRelativePathname()}");

                continue;
            }

            $width = imagesx($image);
            $height = imagesy($image);

            if ($width > $maxWidth) {
                $targetHeight = (int) round($height * ($maxWidth / $width));
                $resized = imagescale($image, $maxWidth, $targetHeight, IMG_BICUBIC);

                if ($resized !== false) {
                    imagedestroy($image);
                    $image = $resized;
                }
            }

            imageinterlace($image, true);
            imagejpeg($image, $path, $quality);
            imagedestroy($image);

            clearstatcache(true, $path);
            $after = filesize($path);
            $savedBytes += max(0, $before - $after);
            $processed++;

            $this->line(sprintf(
                '%s  %s → %s',
                $file->getRelativePathname(),
                $this->humanSize($before),
                $this->humanSize($after)
            ));
        }

        $this->newLine();
        $this->info(sprintf('%d görsel işlendi, %s tasarruf edildi.', $processed, $this->humanSize($savedBytes)));

        return self::SUCCESS;
    }

    private function humanSize(int $bytes): string
    {
        return $bytes > 1048576
            ? round($bytes / 1048576, 2).' MB'
            : round($bytes / 1024).' KB';
    }
}
