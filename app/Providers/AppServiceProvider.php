<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Canonical adreslerin ve sitemap bağlantılarının her zaman tek bir
        // alan adı ve şema üzerinden üretilmesini garanti eder (www/non-www
        // ve http/https kopya içerik sorununu önler).
        if ($this->app->environment('production')) {
            $appUrl = (string) config('app.url');

            if ($appUrl !== '') {
                URL::forceRootUrl($appUrl);
            }

            if (str_starts_with($appUrl, 'https://')) {
                URL::forceScheme('https');
            }
        }
    }
}
