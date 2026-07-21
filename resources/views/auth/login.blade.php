<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giriş | Öz Lider Alüminyum Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-shell antialiased">
    <div class="grid min-h-screen lg:grid-cols-[1.05fr_0.95fr]">
        <section class="admin-login-hero relative hidden overflow-hidden p-12 text-white lg:flex lg:flex-col lg:justify-between">
            <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
            <div class="relative">
                <div class="flex items-center gap-3">
                    <span class="admin-logo-mark">ÖL</span>
                    <div>
                        <p class="admin-heading text-lg text-white">Öz Lider Alüminyum</p>
                        <p class="admin-eyebrow text-[0.72rem] !text-[var(--color-champagne)]">Yönetim Paneli</p>
                    </div>
                </div>
                <h1 class="admin-heading mt-14 max-w-md text-4xl leading-tight text-white">İçeriklerinizi tek merkezden yönetin.</h1>
                <p class="mt-5 max-w-md text-sm leading-7 text-[var(--color-steel)]">Ürünler, kataloglar ve kategoriler admin panelinden anında siteye yansır.</p>
            </div>
            <div class="relative grid max-w-md grid-cols-2 gap-3">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="admin-heading text-2xl text-white">Ürün</p>
                    <p class="mt-1 text-xs text-[var(--color-steel)]">Yönetimi</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="admin-heading text-2xl text-white">Katalog</p>
                    <p class="mt-1 text-xs text-[var(--color-steel)]">PDF yükleme</p>
                </div>
            </div>
        </section>

        <section class="admin-login-panel flex items-center justify-center px-4 py-10 sm:px-8">
            <div class="w-full max-w-md">
                <div class="mb-8 lg:hidden">
                    <div class="flex items-center gap-3">
                        <span class="admin-logo-mark admin-logo-mark--sm">ÖL</span>
                        <div>
                            <p class="admin-heading text-base">Öz Lider Admin</p>
                            <p class="admin-eyebrow text-[0.72rem]">Giriş</p>
                        </div>
                    </div>
                </div>

                <div class="admin-form-card !max-w-none">
                    <p class="admin-eyebrow">Hoş geldiniz</p>
                    <h2 class="admin-heading mt-2 text-3xl">Panele giriş yapın</h2>
                    <p class="mt-2 text-sm admin-text-muted">Hesabınızla devam ederek içerik yönetimine erişin.</p>

                    @if ($errors->any())
                        <div class="admin-alert-error mt-6">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
                        @csrf
                        <div class="admin-field">
                            <label for="email" class="admin-label">E-posta</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required class="admin-input">
                        </div>
                        <div class="admin-field">
                            <label for="password" class="admin-label">Şifre</label>
                            <input id="password" name="password" type="password" required class="admin-input">
                        </div>
                        <label class="admin-checkbox">
                            <input type="checkbox" name="remember">
                            Beni hatırla
                        </label>
                        <button type="submit" class="admin-btn-primary w-full py-3">Giriş Yap</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
