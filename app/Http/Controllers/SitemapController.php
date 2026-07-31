<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $lastProductUpdate = Product::query()->active()->max('updated_at');
        $lastCatalogUpdate = Catalog::query()->max('updated_at');

        $urls = [
            ['loc' => url('/'), 'changefreq' => 'weekly', 'priority' => '1.0', 'lastmod' => $lastProductUpdate],
            ['loc' => route('products.index'), 'changefreq' => 'weekly', 'priority' => '0.9', 'lastmod' => $lastProductUpdate],
            ['loc' => route('catalog.index'), 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => $lastCatalogUpdate],
            ['loc' => route('about.index'), 'changefreq' => 'yearly', 'priority' => '0.7', 'lastmod' => null],
        ];

        $categories = Category::query()
            ->active()
            ->ordered()
            ->has('products')
            ->get();

        foreach ($categories as $category) {
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
            $xml .= '        <loc>'.htmlspecialchars($url['loc'], ENT_XML1).'</loc>'."\n";

            if (! empty($url['lastmod'])) {
                $xml .= '        <lastmod>'.\Illuminate\Support\Carbon::parse($url['lastmod'])->toAtomString().'</lastmod>'."\n";
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
}
