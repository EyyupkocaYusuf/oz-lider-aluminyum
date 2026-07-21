<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | Öz Lider Alüminyum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])
</head>
<body class="admin-shell antialiased">
    <div id="admin-flash" hidden></div>
    <script>
        window.__ADMIN_FLASH__ = {
            success: @json(session('success')),
            error: @json($errors->any() ? $errors->first() : null)
        };
    </script>

    <div id="admin-toast-host" class="admin-toast-host" aria-live="polite"></div>

    <div id="admin-delete-modal" class="admin-modal" role="dialog" aria-modal="true" aria-labelledby="admin-delete-title">
        <div class="admin-modal__backdrop" data-delete-cancel></div>
        <div class="admin-modal__panel">
            <div class="admin-modal__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 3.2 21.5 20.2H2.5L12 3.2Z" fill="#ef4444"/>
                    <path d="M12 9v5.2" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/>
                    <circle cx="12" cy="17.2" r="1.15" fill="#fff"/>
                </svg>
            </div>
            <h3 id="admin-delete-title" class="admin-modal__title" data-delete-title>Silme onayı</h3>
            <p class="admin-modal__message" data-delete-message>Bu kaydı silmek istediğinize emin misiniz?</p>
            <div class="admin-modal__actions">
                <button type="button" class="admin-btn-secondary" data-delete-cancel>Vazgeç</button>
                <button type="button" class="admin-btn-danger-solid" data-delete-confirm>Evet, Sil</button>
            </div>
        </div>
    </div>

    <div class="flex min-h-screen">
        <aside class="admin-sidebar hidden w-[17.5rem] shrink-0 text-white lg:flex lg:flex-col">
            <div class="border-b border-white/10 px-6 py-7">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <span class="admin-logo-mark">ÖL</span>
                    <span>
                        <span class="admin-heading block text-base">Öz Lider Admin</span>
                        <span class="admin-eyebrow block text-[0.72rem] !text-[var(--color-champagne)]">Kontrol Merkezi</span>
                    </span>
                </a>
            </div>

            <nav class="flex-1 space-y-1.5 p-4">
                <p class="admin-nav-section">Genel</p>
                <x-admin.nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" label="Dashboard">
                    <svg class="h-[1.1rem] w-[1.1rem] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-5v-6H10v6H5a1 1 0 0 1-1-1v-9.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
                </x-admin.nav-link>

                <p class="admin-nav-section pt-4">İçerik</p>
                <x-admin.nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" label="Kategoriler">
                    <svg class="h-[1.1rem] w-[1.1rem] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h7V4H4v3Zm9 0h7V4h-7v3ZM4 14h7v-3H4v3Zm9 0h7v-3h-7v3ZM4 21h7v-3H4v3Zm9 0h7v-3h-7v3Z" stroke="currentColor" stroke-width="1.7"/></svg>
                </x-admin.nav-link>
                <x-admin.nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" label="Ürünler">
                    <svg class="h-[1.1rem] w-[1.1rem] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 8h10l1 12H6L7 8ZM9 8V6a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                </x-admin.nav-link>
                <x-admin.nav-link :href="route('admin.catalogs.index')" :active="request()->routeIs('admin.catalogs.*')" label="Kataloglar">
                    <svg class="h-[1.1rem] w-[1.1rem] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 4h9l3 3v13H6V4Zm9 0v3h3M8.5 12h7M8.5 16h7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                </x-admin.nav-link>
                <x-admin.nav-link :href="route('admin.messages.index')" :active="request()->routeIs('admin.messages.*')" label="Mesajlar">
                    <svg class="h-[1.1rem] w-[1.1rem] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 6h16v12H4V6Zm0 0 8 6 8-6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </x-admin.nav-link>
            </nav>

            <div class="border-t border-white/10 p-4">
                <a href="{{ url('/') }}" target="_blank" class="admin-nav-link mb-3">
                    <svg class="h-[1.1rem] w-[1.1rem] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M14 5h5v5M10 14 19 5M19 14v5H5V5h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span>Siteyi Görüntüle</span>
                </a>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-3.5">
                    <div class="flex items-center gap-3">
                        <span class="admin-user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="admin-heading truncate text-sm text-white">{{ auth()->user()->name }}</p>
                            <p class="truncate text-xs text-[var(--color-steel)]">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="admin-btn-secondary w-full text-xs">Çıkış Yap</button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="admin-main flex min-w-0 flex-1 flex-col">
            <main class="flex-1 px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
</body>
</html>
