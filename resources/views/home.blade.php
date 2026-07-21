@extends('layouts.app')

@section('title', 'Öz Lider Alüminyum | Ana Sayfa')

@section('content')
    {{-- Hero --}}
    <section class="site-metal-gradient relative isolate overflow-hidden">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="absolute -right-32 top-20 h-96 w-96 rounded-full bg-[var(--color-champagne)]/5 blur-3xl"></div>
        <div class="absolute -left-20 bottom-0 h-72 w-72 rounded-full bg-[var(--color-steel)]/10 blur-3xl"></div>

        <div class="relative mx-auto grid min-h-[88vh] max-w-7xl items-center gap-14 px-4 py-24 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <p class="site-eyebrow">Alüminyum Sistem Çözümleri</p>
                <h1 class="site-heading site-heading--hero mt-6 max-w-2xl text-4xl text-white sm:text-5xl lg:text-[3.25rem]">
                    Mimaride güç, <span class="text-[var(--color-champagne-light)]">detayda mükemmellik</span>
                </h1>
                <p class="mt-7 max-w-lg text-base leading-8 text-[var(--color-steel)] sm:text-lg">
                    Cephe sistemlerinden standart profillere — Öz Lider Alüminyum, projelerinize özel üretim kalitesi ve güvenilir tedarik sunar.
                </p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="{{ url('/urunlerimiz') }}" class="site-btn site-btn--primary">Ürünleri Keşfedin</a>
                    <a href="{{ url('/katalog') }}" class="site-btn site-btn--ghost">Katalogları İnceleyin</a>
                </div>
            </div>

            <div class="site-hero-visual site-hero-visual--photo aspect-[4/5] p-8 lg:aspect-square">
                <div class="relative z-10 flex h-full flex-col justify-between">
                    <div class="flex items-center justify-between text-xs font-semibold tracking-wide text-[var(--color-steel)]">
                        <span>Üretim</span>
                        <span class="text-[var(--color-champagne)]">Premium Kalite</span>
                    </div>
                    <div>
                        <p class="font-display text-8xl font-extrabold leading-none text-white/10">Al</p>
                        <p class="mt-4 max-w-xs text-xl font-semibold leading-snug text-white">
                            Yüksek dayanımlı alüminyum profil ve sistem çözümleri
                        </p>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="site-stat">
                            <p class="site-stat__value">15+</p>
                            <p class="site-stat__label">Yıl Tecrübe</p>
                        </div>
                        <div class="site-stat">
                            <p class="site-stat__value">500+</p>
                            <p class="site-stat__label">Proje</p>
                        </div>
                        <div class="site-stat">
                            <p class="site-stat__value">%100</p>
                            <p class="site-stat__label">Kalite Odak</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Ürünler --}}
    <section class="site-section site-section--light">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="site-eyebrow !text-[var(--color-copper)]">Ürün Gamı</p>
                    <h2 class="site-heading mt-4 text-3xl text-[var(--color-ink)] sm:text-4xl">Öne çıkan sistemlerimiz</h2>
                </div>
                <a href="{{ url('/urunlerimiz') }}" class="site-btn site-btn--dark self-start">Tüm Ürünler</a>
            </div>

            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($products as $product)
                    <article class="site-card--light group overflow-hidden !rounded-2xl">
                        @if ($product->image_url)
                            <div class="aspect-[4/3] overflow-hidden">
                                <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            </div>
                        @else
                            <div class="flex aspect-[4/3] items-center justify-center bg-[var(--color-mist)]">
                                <span class="font-display text-3xl font-extrabold text-[var(--color-steel)]/30">ÖL</span>
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="site-subheading text-lg text-[var(--color-ink)]">{{ $product->title }}</h3>
                        </div>
                    </article>
                @empty
                    <div class="site-empty col-span-full">Henüz öne çıkan ürün eklenmemiş.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Hakkımızda özet --}}
    <section class="site-section site-section--dark">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div class="site-about-slider" data-about-slider>
                @forelse ($galleryImages as $index => $image)
                    <div class="site-about-slider__slide {{ $index === 0 ? 'is-active' : '' }}" data-about-slide>
                        <img src="{{ $image }}" alt="Öz Lider Alüminyum dükkan görseli {{ $index + 1 }}" class="site-about-slider__image">
                    </div>
                @empty
                    <div class="site-about-slider__slide is-active" data-about-slide>
                        <div class="site-about-slider__placeholder">
                            <p class="site-eyebrow">Hakkımızda</p>
                            <p class="site-subheading mt-4 text-2xl text-white sm:text-3xl">
                                Alüminyumda güvenilir üretim, güçlü proje ortaklığı
                            </p>
                        </div>
                    </div>
                @endforelse

                <div class="site-about-slider__overlay"></div>

                @if (count($galleryImages) > 0)
                    <div class="site-about-slider__caption">
                        <p class="site-eyebrow">Hakkımızda</p>
                        <p class="site-subheading mt-3 text-xl text-white sm:text-2xl">
                            Alüminyumda güvenilir üretim, güçlü proje ortaklığı
                        </p>
                    </div>
                @endif

                @if (count($galleryImages) > 1)
                    <div class="site-about-slider__dots">
                        @foreach ($galleryImages as $index => $image)
                            <button
                                type="button"
                                class="site-about-slider__dot {{ $index === 0 ? 'is-active' : '' }}"
                                data-about-slider-dot
                                aria-label="Görsel {{ $index + 1 }}"
                            ></button>
                        @endforeach
                    </div>
                @endif
            </div>
            <div>
                <p class="site-eyebrow">Neden Öz Lider?</p>
                <h2 class="site-heading mt-4 text-3xl text-white sm:text-4xl">Kaliteyi üretimin her aşamasında yaşatıyoruz</h2>
                <p class="mt-6 leading-8 text-[var(--color-steel)]">
                    Profil sistemleri, cephe çözümleri ve yalıtımlı doğrama gruplarında modern üretim anlayışıyla müşterilerimize uzun ömürlü, estetik ve uygulanabilir çözümler sunuyoruz.
                </p>
                <a href="{{ url('/hakkimizda') }}" class="site-btn site-btn--primary mt-8">Firmamızı Tanıyın</a>
            </div>
        </div>
    </section>

    {{-- Değerler --}}
    <section class="site-section site-section--light">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="site-eyebrow mx-auto !text-[var(--color-copper)]">Değerlerimiz</p>
                <h2 class="site-heading mt-4 text-3xl text-[var(--color-ink)] sm:text-4xl">Güven inşa eden üç temel</h2>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article class="site-value-card text-center">
                    <p class="site-value-card__num">01</p>
                    <h3 class="site-subheading mt-4 text-xl">Üstün Malzeme</h3>
                    <p class="mt-3 text-sm leading-7 text-[#64748b]">Dayanıklı alüminyum profiller için seçkin hammadde ve kontrollü üretim süreçleri.</p>
                </article>
                <article class="site-value-card text-center">
                    <p class="site-value-card__num">02</p>
                    <h3 class="site-subheading mt-4 text-xl">Proje Odaklılık</h3>
                    <p class="mt-3 text-sm leading-7 text-[#64748b]">Her projenin ihtiyacına özel ölçü, uygulama ve teknik danışmanlık desteği.</p>
                </article>
                <article class="site-value-card text-center">
                    <p class="site-value-card__num">03</p>
                    <h3 class="site-subheading mt-4 text-xl">Zamanında Teslim</h3>
                    <p class="mt-3 text-sm leading-7 text-[#64748b]">Planlı üretim ve sevkiyat ile projelerinizin takvimine saygı duyuyoruz.</p>
                </article>
            </div>
        </div>
    </section>

    {{-- İletişim --}}
    <section id="iletisim" class="site-section site-metal-gradient relative">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="relative mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <p class="site-eyebrow">İletişim</p>
                <h2 class="site-heading mt-4 text-3xl text-white sm:text-4xl">Projeniz için teklif alın</h2>
                <p class="mt-6 leading-8 text-[var(--color-steel)]">
                    Ürün bilgisi, katalog talebi veya proje danışmanlığı için formu doldurun. Ekibimiz en kısa sürede size dönüş yapacaktır.
                </p>
                <div class="mt-8 space-y-3 text-sm text-[var(--color-steel)]">
                    <p>📍 Bingöl/Merkez</p>
                    <p>✉ info@ozlideraluminyum.com</p>
                    <p>☎ +90 000 000 00 00</p>
                </div>
            </div>
            <form class="site-card !rounded-2xl p-7" method="POST" action="{{ route('contact.store') }}">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <input class="site-input" name="name" type="text" placeholder="Ad Soyad" value="{{ old('name') }}" required>
                    <input class="site-input" name="phone" type="tel" placeholder="Telefon" value="{{ old('phone') }}" required>
                </div>
                <input class="site-input mt-4" name="email" type="email" placeholder="E-posta" value="{{ old('email') }}" required>
                <textarea class="site-input mt-4 min-h-32 resize-none" name="message" placeholder="Projeniz hakkında kısa bilgi..." required>{{ old('message') }}</textarea>
                <button class="site-btn site-btn--primary mt-5 w-full" type="submit">Mesaj Gönder</button>
            </form>
        </div>
    </section>
@endsection
