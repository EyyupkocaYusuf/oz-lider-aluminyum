@extends('layouts.app')

@section('title', 'Bingöl Alüminyum | Öz Lider Alüminyum - Kapı, Pencere ve Cephe Sistemleri')
@section('meta_description', 'Bingöl alüminyum firması Öz Lider Alüminyum; alüminyum kapı, pencere, giydirme cephe, kompozit cephe kaplama ve ısı yalıtımlı doğrama sistemleri sunar. Bingöl Merkez’de ücretsiz keşif, ölçü ve montaj için hemen teklif alın.')
@section('meta_keywords', 'Bingöl alüminyum, Bingöl alüminyum doğrama, Bingöl cephe sistemleri, Bingöl kompozit cephe, alüminyum kapı Bingöl, alüminyum pencere Bingöl, giydirme cephe Bingöl, ısı yalıtımlı alüminyum, Öz Lider Alüminyum')
@section('canonical', url('/'))

@php
    $faqs = [
        [
            'q' => 'Bingöl’de alüminyum doğrama fiyatları nasıl belirleniyor?',
            'a' => 'Alüminyum kapı ve pencere fiyatları; seçilen profil serisine, cam paketine, ısı yalıtımı ihtiyacına ve toplam metrekareye göre değişir. Bingöl Merkez ve çevre ilçelerde ücretsiz keşif yapıp projenize özel net fiyat teklifi hazırlıyoruz.',
        ],
        [
            'q' => 'Kompozit cephe kaplaması ile giydirme cephe arasındaki fark nedir?',
            'a' => 'Kompozit cephe kaplaması, alüminyum kompozit panellerle binanın dış yüzeyini kaplayarak estetik ve koruma sağlar. Giydirme cephe ise taşıyıcı alüminyum konstrüksiyon üzerine cam veya panel uygulanan, binayı bütünüyle saran bir cephe sistemidir. İki çözümü de projenizin ihtiyacına göre uyguluyoruz.',
        ],
        [
            'q' => 'Hangi bölgelerde hizmet veriyorsunuz?',
            'a' => 'Bingöl Merkez başta olmak üzere Genç, Solhan, Karlıova, Adaklı, Yayladere, Yedisu ve Kiğı ilçelerinde alüminyum doğrama, cephe ve kompozit kaplama işleri yapıyoruz.',
        ],
        [
            'q' => 'Isı yalıtımlı alüminyum sistemler gerçekten tasarruf sağlıyor mu?',
            'a' => 'Evet. Isı yalıtımlı (polyamid barlı) alüminyum profiller, iç ve dış yüzey arasındaki ısı geçişini keserek kışın ısı kaybını, yazın ise ısı kazancını belirgin şekilde azaltır. Bu da ısıtma ve soğutma giderlerinde tasarruf anlamına gelir.',
        ],
        [
            'q' => 'Projemin ölçüsünü ve montajını siz mi yapıyorsunuz?',
            'a' => 'Evet. Keşif, ölçü alma, üretim, sevkiyat ve montaj süreçlerinin tamamını kendi ekibimizle yürütüyoruz. Böylece iş tek elden takip edilir ve teslim süresi kısalır.',
        ],
    ];

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(fn ($faq) => [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']],
        ], $faqs),
    ];

    $services = config('seo-services');
@endphp

@push('schema')
    <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@section('content')
    {{-- Hero --}}
    <section class="site-metal-gradient relative isolate overflow-hidden">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="absolute -right-32 top-20 h-96 w-96 rounded-full bg-[var(--color-champagne)]/5 blur-3xl"></div>
        <div class="absolute -left-20 bottom-0 h-72 w-72 rounded-full bg-[var(--color-steel)]/10 blur-3xl"></div>

        <div class="relative mx-auto grid min-h-[88vh] max-w-7xl items-center gap-14 px-4 py-24 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <p class="site-eyebrow">Bingöl Alüminyum Sistem Çözümleri</p>
                <h1 class="site-heading site-heading--hero mt-6 max-w-2xl text-4xl text-white sm:text-5xl lg:text-[3.25rem]">
                    Bingöl’de alüminyum kapı, pencere ve <span class="text-[var(--color-champagne-light)]">cephe sistemleri</span>
                </h1>
                <p class="mt-7 max-w-lg text-base leading-8 text-[var(--color-steel)] sm:text-lg">
                    Öz Lider Alüminyum; Bingöl Merkez ve çevre ilçelerde giydirme cephe, kompozit cephe kaplama, ısı yalıtımlı doğrama ve sürme sistemlerinde ölçü, üretim ve montaj hizmeti sunar.
                </p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="{{ url('/urunlerimiz') }}" class="site-btn site-btn--primary">Ürünleri Keşfedin</a>
                    <a href="{{ url('/#iletisim') }}" class="site-btn site-btn--ghost">Ücretsiz Keşif ve Teklif</a>
                </div>
            </div>

            <div class="site-hero-visual site-hero-visual--photo aspect-[4/5] p-8 lg:aspect-square">
                <div class="relative z-10 flex h-full flex-col justify-between">
                    <div class="flex items-center justify-between text-xs font-semibold tracking-wide text-[var(--color-steel)]">
                        <span>Bingöl / Merkez</span>
                        <span class="text-[var(--color-champagne)]">Premium Kalite</span>
                    </div>
                    <div>
                        <p class="font-display text-8xl font-extrabold leading-none text-white/10" aria-hidden="true">Al</p>
                        <p class="mt-4 max-w-xs text-xl font-semibold leading-snug text-white">
                            Yüksek dayanımlı alüminyum profil ve cephe sistemleri
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

    {{-- Hizmetler --}}
    <section class="site-section site-section--light" id="hizmetler">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="site-eyebrow !text-[var(--color-copper)]">Hizmetlerimiz</p>
                <h2 class="site-heading mt-4 text-3xl text-[var(--color-ink)] sm:text-4xl">
                    Bingöl alüminyum cephe ve kompozit kaplama hizmetleri
                </h2>
                <p class="mt-5 text-base leading-8 text-[#64748b]">
                    Alüminyum doğramadan giydirme cepheye, kompozit panel kaplamadan korkuluk sistemlerine kadar tüm uygulamaları tek çatı altında topluyoruz.
                </p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $serviceSlug => $service)
                    <a href="{{ route('service.show', $serviceSlug) }}" class="site-value-card block">
                        <h3 class="site-subheading text-lg text-[var(--color-ink)]">{{ $service['h1'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-[#64748b]">{{ $service['lead'] }}</p>
                        <span class="mt-5 inline-block text-sm font-semibold text-[var(--color-copper)]">Detayları görün →</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Ürünler --}}
    <section class="site-section site-section--dark">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="site-eyebrow">Ürün Gamı</p>
                    <h2 class="site-heading mt-4 text-3xl text-white sm:text-4xl">Öne çıkan alüminyum sistemlerimiz</h2>
                </div>
                <a href="{{ url('/urunlerimiz') }}" class="site-btn site-btn--primary self-start">Tüm Ürünler</a>
            </div>

            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($products as $product)
                    <article class="site-card group overflow-hidden !rounded-2xl">
                        @if ($product->image_url)
                            <div class="aspect-[4/3] overflow-hidden">
                                <img
                                    src="{{ $product->image_url }}"
                                    alt="{{ $product->title }} — Bingöl alüminyum sistemleri"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                        @else
                            <div class="flex aspect-[4/3] items-center justify-center bg-white/5">
                                <span class="font-display text-3xl font-extrabold text-[var(--color-steel)]/30" aria-hidden="true">ÖL</span>
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="site-subheading text-lg text-white">{{ $product->title }}</h3>
                        </div>
                    </article>
                @empty
                    <div class="site-empty col-span-full">Henüz öne çıkan ürün eklenmemiş.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Hakkımızda özet --}}
    <section class="site-section site-section--light">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div class="site-about-slider" data-about-slider>
                @forelse ($galleryImages as $index => $image)
                    <div class="site-about-slider__slide {{ $index === 0 ? 'is-active' : '' }}" data-about-slide>
                        <img
                            src="{{ $image }}"
                            alt="Öz Lider Alüminyum Bingöl atölyesi ve alüminyum sistem uygulamaları {{ $index + 1 }}"
                            class="site-about-slider__image"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                @empty
                    <div class="site-about-slider__slide is-active" data-about-slide>
                        <div class="site-about-slider__placeholder">
                            <p class="site-eyebrow">Hakkımızda</p>
                            <p class="site-subheading mt-4 text-2xl text-white sm:text-3xl">
                                Bingöl’de alüminyumda güvenilir üretim ortağı
                            </p>
                        </div>
                    </div>
                @endforelse

                <div class="site-about-slider__overlay"></div>

                @if (count($galleryImages) > 0)
                    <div class="site-about-slider__caption">
                        <p class="site-eyebrow">Hakkımızda</p>
                        <p class="site-subheading mt-3 text-xl text-white sm:text-2xl">
                            Bingöl’de alüminyumda güvenilir üretim ortağı
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
                <p class="site-eyebrow !text-[var(--color-copper)]">Neden Öz Lider Alüminyum?</p>
                <h2 class="site-heading mt-4 text-3xl text-[var(--color-ink)] sm:text-4xl">
                    Bingöl’ün alüminyum sistemlerde tercih edilen firması
                </h2>
                <p class="mt-6 leading-8 text-[#64748b]">
                    Profil sistemleri, giydirme cephe çözümleri, kompozit panel kaplama ve ısı yalıtımlı doğrama gruplarında modern üretim anlayışıyla çalışıyoruz. Bingöl Merkez’deki atölyemizde ürettiğimiz sistemleri kendi ekibimizle monte ediyor, projelerinize uzun ömürlü ve estetik çözümler sunuyoruz.
                </p>
                <a href="{{ url('/hakkimizda') }}" class="site-btn site-btn--dark mt-8">Firmamızı Tanıyın</a>
            </div>
        </div>
    </section>

    {{-- Değerler --}}
    <section class="site-section site-section--dark">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="site-eyebrow mx-auto">Değerlerimiz</p>
                <h2 class="site-heading mt-4 text-3xl text-white sm:text-4xl">Güven inşa eden üç temel</h2>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article class="site-card p-8 text-center">
                    <p class="font-display text-4xl font-extrabold text-[var(--color-champagne)]" aria-hidden="true">01</p>
                    <h3 class="site-subheading mt-4 text-xl text-white">Üstün Malzeme</h3>
                    <p class="mt-3 text-sm leading-7 text-[var(--color-steel)]">Dayanıklı alüminyum profiller için seçkin hammadde ve kontrollü üretim süreçleri.</p>
                </article>
                <article class="site-card p-8 text-center">
                    <p class="font-display text-4xl font-extrabold text-[var(--color-champagne)]" aria-hidden="true">02</p>
                    <h3 class="site-subheading mt-4 text-xl text-white">Proje Odaklılık</h3>
                    <p class="mt-3 text-sm leading-7 text-[var(--color-steel)]">Her projenin ihtiyacına özel ölçü, uygulama ve teknik danışmanlık desteği.</p>
                </article>
                <article class="site-card p-8 text-center">
                    <p class="font-display text-4xl font-extrabold text-[var(--color-champagne)]" aria-hidden="true">03</p>
                    <h3 class="site-subheading mt-4 text-xl text-white">Zamanında Teslim</h3>
                    <p class="mt-3 text-sm leading-7 text-[var(--color-steel)]">Planlı üretim ve sevkiyat ile projelerinizin takvimine saygı duyuyoruz.</p>
                </article>
            </div>
        </div>
    </section>

    {{-- SSS --}}
    <section class="site-section site-section--light" id="sss">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="site-eyebrow mx-auto !text-[var(--color-copper)]">Sıkça Sorulan Sorular</p>
                <h2 class="site-heading mt-4 text-3xl text-[var(--color-ink)] sm:text-4xl">
                    Bingöl alüminyum sistemleri hakkında merak edilenler
                </h2>
            </div>

            <div class="site-faq mt-12">
                @foreach ($faqs as $index => $faq)
                    <details class="site-faq__item" {{ $index === 0 ? 'open' : '' }}>
                        <summary class="site-faq__question">
                            <h3>{{ $faq['q'] }}</h3>
                            <span class="site-faq__icon" aria-hidden="true"></span>
                        </summary>
                        <div class="site-faq__answer">{{ $faq['a'] }}</div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- İletişim --}}
    <section id="iletisim" class="site-section site-metal-gradient relative">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="relative mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <p class="site-eyebrow">İletişim</p>
                <h2 class="site-heading mt-4 text-3xl text-white sm:text-4xl">Bingöl’de projeniz için teklif alın</h2>
                <p class="mt-6 leading-8 text-[var(--color-steel)]">
                    Alüminyum doğrama, giydirme cephe veya kompozit kaplama projeniz için formu doldurun. Bingöl Merkez ve çevre ilçelerde ücretsiz keşif yapıp en kısa sürede dönüş sağlıyoruz.
                </p>
                <address class="mt-8 space-y-3 text-sm not-italic text-[var(--color-steel)]">
                    <p>📍 {{ config('seo.address.display') }}</p>
                    <p>✉ <a class="transition hover:text-[var(--color-champagne-light)]" href="mailto:{{ config('seo.email') }}">{{ config('seo.email') }}</a></p>
                    <p>☎ <a class="transition hover:text-[var(--color-champagne-light)]" href="tel:{{ config('seo.phone_link') }}">{{ config('seo.phone') }}</a></p>
                </address>
            </div>
            <form class="site-card !rounded-2xl p-7" method="POST" action="{{ route('contact.store') }}">
                @csrf
                <h2 class="sr-only">Teklif formu</h2>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="sr-only" for="contact-name">Ad Soyad</label>
                        <input id="contact-name" class="site-input" name="name" type="text" placeholder="Ad Soyad" value="{{ old('name') }}" required>
                    </div>
                    <div>
                        <label class="sr-only" for="contact-phone">Telefon</label>
                        <input id="contact-phone" class="site-input" name="phone" type="tel" placeholder="Telefon" value="{{ old('phone') }}" required>
                    </div>
                </div>
                <label class="sr-only" for="contact-email">E-posta</label>
                <input id="contact-email" class="site-input mt-4" name="email" type="email" placeholder="E-posta" value="{{ old('email') }}" required>
                <label class="sr-only" for="contact-message">Mesajınız</label>
                <textarea id="contact-message" class="site-input mt-4 min-h-32 resize-none" name="message" placeholder="Projeniz hakkında kısa bilgi..." required>{{ old('message') }}</textarea>
                <button class="site-btn site-btn--primary mt-5 w-full" type="submit">Mesaj Gönder</button>
            </form>
        </div>
    </section>
@endsection
