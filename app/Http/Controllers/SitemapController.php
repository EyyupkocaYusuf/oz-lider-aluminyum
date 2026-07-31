<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Throwable;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            ['loc' => url('/'), 'changefreq' => 'weekly', 'priority' => '1.0', 'lastmod' => $this->latestUpdate(Product::class)],
            ['loc' => route('products.index'), 'changefreq' => 'weekly', 'priority' => '0.9', 'lastmod' => $this->latestUpdate(Product::class)],
            ['loc' => route('catalog.index'), 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => $this->latestUpdate(Catalog::class)],
            ['loc' => route('about.index'), 'changefreq' => 'yearly', 'priority' => '0.7', 'lastmod' => null],
        ];

        foreach ($this->categories() as $category) {
            $urls[] = [
                'loc' => route('products.index', ['kategori' => $category->slug]),
                'changefreq' => 'weekly',
                'priority' => '0.8',
                'lastmod' => $category->updated_at,
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $url) {
            $xml .= "    <url>\n";
            $xml .= '        <loc>'.htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8').'</loc>'."\n";

            if ($lastmod = $this->formatDate($url['lastmod'])) {
                $xml .= '        <lastmod>'.$lastmod.'</lastmod>'."\n";
            }

            $xml .= '        <changefreq>'.$url['changefreq'].'</changefreq>'."\n";
            $xml .= '        <priority>'.$url['priority'].'</priority>'."\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            'Disallow: /admin',
            'Disallow: /admin/',
            '',
            'Sitemap: '.url('/sitemap.xml'),
            '',
        ];

        return response(implode("\n", $lines), 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    /**
     * Sitemap, veritabanı kaynaklı tek bir hata yüzünden tamamen
     * erişilemez olmamalı; sorun çıkarsa statik sayfalarla yayınlanır.
     */
    private function categories()
    {
        try {
            return Category::query()->active()->ordered()->get();
        } catch (Throwable) {
            return collect();
        }
    }

    private function latestUpdate(string $model): ?string
    {
        try {
            return $model::query()->max('updated_at');
        } catch (Throwable) {
            return null;
        }
    }

    private function formatDate(mixed $value): ?string
    {
        if (empty($value) || str_starts_with((string) $value, '0000')) {
            return null;
        }

        try {
            return Carbon::parse($value)->toAtomString();
        } catch (Throwable) {
            return null;
        }
    }
}
