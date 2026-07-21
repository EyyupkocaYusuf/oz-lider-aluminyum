<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class AboutGallery
{
    public static function homeImages(): array
    {
        return self::imagesFrom('images/home');
    }

    public static function aboutImages(): array
    {
        return self::imagesFrom('images/about');
    }

    private static function imagesFrom(string $relativePath): array
    {
        $galleryPath = public_path($relativePath);

        if (! File::isDirectory($galleryPath)) {
            return [];
        }

        return collect(File::files($galleryPath))
            ->filter(fn ($file) => in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp'], true))
            ->sortBy(fn ($file) => $file->getFilename())
            ->values()
            ->map(fn ($file) => asset($relativePath.'/'.$file->getFilename()))
            ->all();
    }
}
