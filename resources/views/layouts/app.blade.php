<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-body antialiased">
    <div id="site-toast-host" class="admin-toast-host" aria-live="polite"></div>
    <script>
        window.__SITE_FLASH__ = {
            success: @json(session('success')),
            error: @json($errors->any() ? $errors->first() : null)
        };
    </script>

    <header class="site-header sticky top-0 z-50">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="group flex items-center gap-3.5" aria-label="Öz Lider Alüminyum ana sayfa">
                <span class="site-logo-mark transition group-hover:border-[var(--color-champagne)]" aria-hidden="true">ÖL</span>
                <span>
                    <span class="font-display block text-base font-bold tracking-tight text-white">Öz Lider Alüminyum</span>
                    <span class="block text-[0.65rem] font-semibold uppercase tracking-[0.32em] text-[var(--color-steel)]">Bingöl Alüminyum Sistemleri</span>
                </span>
            </a>

            <nav class="hidden items-center gap-9 md:flex" aria-label="Ana menü">
                <a class="site-nav-link {{ request()->is('/') ? 'is-active' : '' }}" href="{{ url('/') }}">Ana Sayfa</a>
                <a class="site-nav-link {{ request()->is('hakkimizda') ? 'is-active' : '' }}" href="{{ url('/hakkimizda') }}">Hakkımızda</a>
                <a class="site-nav-link {{ request()->is('urunlerimiz') ? 'is-active' : '' }}" href="{{ url('/urunlerimiz') }}">Ürünlerimiz</a>
                <a class="site-nav-link {{ request()->is('katalog') ? 'is-active' : '' }}" href="{{ url('/katalog') }}">Katalog</a>
                <a class="site-btn site-btn--primary !py-2.5 !px-5" href="{{ url('/#iletisim') }}">Teklif Alın</a>
            </nav>

            <nav class="flex gap-2 md:hidden" aria-label="Kısa menü">
                <a class="site-btn site-btn--ghost !px-3 !py-2 text-xs" href="{{ url('/urunlerimiz') }}">Ürünler</a>
                <a class="site-btn site-btn--primary !px-3 !py-2 text-xs" href="{{ url('/#iletisim') }}">İletişim</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="grid gap-10 md:grid-cols-12">
                <div class="md:col-span-5">
                    <div class="flex items-center gap-3">
                        <span class="site-logo-mark !h-10 !w-10 text-xs" aria-hidden="true">ÖL</span>
                        <span class="font-display text-lg font-bold text-white">Öz Lider Alüminyum</span>
                    </div>
                    <p class="mt-5 max-w-sm text-sm leading-7 text-[var(--color-steel)]">
                        Bingöl’de alüminyum kapı, pencere, giydirme cephe ve kompozit cephe sistemlerinde ölçü, üretim ve montaj hizmeti sunuyoruz. Projelerinize değer katan kaliteli çözümler.
                    </p>
                </div>
                <div class="md:col-span-3">
                    <h2 class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--color-champagne)]">Sayfalar</h2>
                    <nav class="mt-4 flex flex-col gap-2.5 text-sm text-[var(--color-steel)]" aria-label="Alt menü">
                        <a class="transition hover:text-[var(--color-champagne-light)]" href="{{ url('/') }}">Ana Sayfa</a>
                        <a class="transition hover:text-[var(--color-champagne-light)]" href="{{ url('/hakkimizda') }}">Hakkımızda</a>
                        <a class="transition hover:text-[var(--color-champagne-light)]" href="{{ url('/urunlerimiz') }}">Ürünlerimiz</a>
                        <a class="transition hover:text-[var(--color-champagne-light)]" href="{{ url('/katalog') }}">Katalog</a>
                        <a class="transition hover:text-[var(--color-champagne-light)]" href="{{ url('/#iletisim') }}">İletişim</a>
                    </nav>
                </div>
                <div class="md:col-span-4">
                    <h2 class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--color-champagne)]">İletişim</h2>
                    <address class="mt-4 space-y-2 text-sm not-italic text-[var(--color-steel)]">
                        <p>{{ config('seo.address.display') }}</p>
                        <p><a class="transition hover:text-[var(--color-champagne-light)]" href="mailto:{{ config('seo.email') }}">{{ config('seo.email') }}</a></p>
                        <p><a class="transition hover:text-[var(--color-champagne-light)]" href="tel:{{ config('seo.phone_link') }}">{{ config('seo.phone') }}</a></p>
                    </address>
                </div>
            </div>

            <div class="site-divider mt-12"></div>

            <p class="mt-8 text-xs leading-6 text-[var(--color-steel)]/80">
                <strong class="text-[var(--color-steel)]">Hizmet bölgelerimiz:</strong>
                {{ implode(', ', config('seo.service_areas')) }} ve çevre ilçeler.
            </p>
            <p class="mt-6 text-center text-xs text-[var(--color-steel)]">&copy; {{ date('Y') }} Öz Lider Alüminyum. Tüm hakları saklıdır.</p>
        </div>
    </footer>
</body>
</html>
