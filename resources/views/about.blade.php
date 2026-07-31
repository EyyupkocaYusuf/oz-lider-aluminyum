@extends('layouts.app')

@section('title', 'Hakkımızda | Bingöl Alüminyum Firması - Öz Lider Alüminyum')
@section('meta_description', 'Öz Lider Alüminyum, Bingöl Merkez’de alüminyum doğrama, giydirme cephe ve kompozit cephe kaplama üretimi yapan yerel firmadır. Deneyimli ekibimiz, üretim altyapımız ve proje odaklı hizmet anlayışımızla tanışın.')
@section('meta_keywords', 'Bingöl alüminyum firması, Bingöl alüminyum atölyesi, Bingöl cephe firması, alüminyum doğrama Bingöl, Öz Lider Alüminyum hakkında')
@section('canonical', route('about.index'))

@section('content')
    <section class="site-page-hero site-metal-gradient relative">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['label' => 'Hakkımızda', 'url' => route('about.index')]]" />

            <div class="mt-8 grid items-center gap-12 lg:grid-cols-2">
                <div>
                    <p class="site-eyebrow">Hakkımızda</p>
                    <h1 class="site-heading site-heading--hero mt-5 text-4xl text-white sm:text-5xl">
                        Bingöl’de alüminyum sistemlerde güvenilir üretim ortağı
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-[var(--color-steel)]">
                        Öz Lider Alüminyum; Bingöl Merkez’deki atölyesinde profil sistemleri, giydirme cephe çözümleri, kompozit cephe kaplama ve ısı yalıtımlı doğrama gruplarında üretim yapar. Kaliteyi, hızlı üretimi ve proje odaklı hizmet anlayışını bir araya getiririz.
                    </p>
                </div>

                <div class="site-about-slider" data-about-slider>
                    @forelse ($galleryImages as $index => $image)
                        <div
                            class="site-about-slider__slide {{ $index === 0 ? 'is-active' : '' }}"
                            data-about-slide
                        >
                            <img
                                src="{{ $image }}"
                                alt="Öz Lider Alüminyum Bingöl atölyesi ve üretim alanı {{ $index + 1 }}"
                                class="site-about-slider__image"
                                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                fetchpriority="{{ $index === 0 ? 'high' : 'auto' }}"
                                decoding="async"
                            >
                        </div>
                    @empty
                        <div class="site-about-slider__slide is-active" data-about-slide>
                            <div class="site-about-slider__placeholder">
                                <p class="site-eyebrow !text-[var(--color-champagne)]">Dükkan Görselleri</p>
                                <p class="site-subheading mt-4 text-xl text-white">Fotoğraflar yakında eklenecek</p>
                            </div>
                        </div>
                    @endforelse

                    <div class="site-about-slider__overlay"></div>

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
            </div>
        </div>
    </section>

    <section class="site-section site-section--light">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-[1fr_1.2fr] lg:px-8">
            <div>
                <p class="site-eyebrow !text-[var(--color-copper)]">Firma Tanıtımı</p>
                <h2 class="site-heading mt-4 text-3xl text-[var(--color-ink)] sm:text-4xl">
                    Güçlü üretim altyapısı, esnek proje yaklaşımı
                </h2>
            </div>
            <div class="space-y-6 text-base leading-8 text-[#64748b]">
                <p>Öz Lider Alüminyum, Bingöl ve çevresinde alüminyum profil ile mimari sistem çözümlerinde müşterilerine dayanıklı, estetik ve uygulanabilir ürünler sunmayı hedefler. Keşiften ölçü almaya, üretimden montaja kadar her aşamada kalite kontrol süreçlerini titizlikle uygularız.</p>
                <p>Modern üretim yaklaşımımız, deneyimli ekibimiz ve geniş ürün gamımız sayesinde konut, ticari yapı ve endüstriyel projelerde uzun ömürlü çözümler geliştiriyoruz. Alüminyum kapı ve pencere doğraması, giydirme cephe, kompozit panel kaplama, sürme sistemler ve korkuluk uygulamalarında tek elden hizmet veriyoruz.</p>
                <p>Bingöl Merkez’in yanı sıra Genç, Solhan, Karlıova, Adaklı, Yayladere, Yedisu ve Kiğı ilçelerinde de projelerinizi hayata geçiriyoruz.</p>
            </div>
        </div>
    </section>

    <section class="site-section site-section--dark">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="site-eyebrow mx-auto">İlkelerimiz</p>
                <h2 class="site-heading mt-4 text-3xl text-white sm:text-4xl">Bizi farklı kılan değerler</h2>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article class="site-card p-8">
                    <p class="font-display text-4xl font-extrabold text-[var(--color-champagne)]" aria-hidden="true">01</p>
                    <h3 class="font-display mt-5 text-xl font-bold text-white">Kaliteli Malzeme</h3>
                    <p class="mt-4 text-sm leading-7 text-[var(--color-steel)]">Dayanıklı alüminyum çözümler için doğru hammadde ve güvenilir üretim süreçleri.</p>
                </article>
                <article class="site-card p-8">
                    <p class="font-display text-4xl font-extrabold text-[var(--color-champagne)]" aria-hidden="true">02</p>
                    <h3 class="font-display mt-5 text-xl font-bold text-white">Proje Odaklılık</h3>
                    <p class="mt-4 text-sm leading-7 text-[var(--color-steel)]">Her projenin ihtiyacını ayrı değerlendirir, ölçü ve uygulama detaylarına uygun çözümler sunarız.</p>
                </article>
                <article class="site-card p-8">
                    <p class="font-display text-4xl font-extrabold text-[var(--color-champagne)]" aria-hidden="true">03</p>
                    <h3 class="font-display mt-5 text-xl font-bold text-white">Zamanında Teslim</h3>
                    <p class="mt-4 text-sm leading-7 text-[var(--color-steel)]">Üretim ve sevkiyat süreçlerini planlı yürütür, hızlı geri dönüş sağlamaya önem veririz.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="site-section site-section--light text-center">
        <div class="mx-auto max-w-2xl px-4">
            <h2 class="site-heading text-2xl text-[var(--color-ink)] sm:text-3xl">Bingöl’deki projeniz için bizimle iletişime geçin</h2>
            <p class="mt-4 text-[#64748b]">Teknik danışmanlık, ücretsiz keşif ve teklif talepleriniz için ekibimiz hazır.</p>
            <a href="{{ url('/#iletisim') }}" class="site-btn site-btn--primary mt-8">Teklif Alın</a>
        </div>
    </section>
@endsection
