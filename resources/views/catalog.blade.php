@extends('layouts.app')

@section('title', 'Alüminyum Sistem Katalogları | Bingöl - Öz Lider Alüminyum')
@section('meta_description', 'Alüminyum kapı, pencere, giydirme cephe ve kompozit sistem kataloglarımızı inceleyin. Profil kesitleri, teknik detaylar ve sistem dosyaları Öz Lider Alüminyum Bingöl’de.')
@section('meta_keywords', 'alüminyum katalog, alüminyum profil kataloğu, cephe sistemleri kataloğu, kompozit cephe kataloğu, Bingöl alüminyum katalog')
@section('canonical', route('catalog.index'))

@section('content')
    <section class="site-page-hero site-metal-gradient relative">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['label' => 'Katalog', 'url' => route('catalog.index')]]" />

            <p class="site-eyebrow mt-8">Kataloglar</p>
            <h1 class="site-heading site-heading--hero mt-5 max-w-3xl text-4xl text-white sm:text-5xl">
                Alüminyum sistem katalogları ve teknik dosyalar
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-[var(--color-steel)]">
                Profil grupları, cephe sistemleri ve kompozit kaplama detaylarını incelemek için katalog dosyalarımızı görüntüleyin. Katalogdaki bir sistem hakkında bilgi almak isterseniz bize ulaşabilirsiniz.
            </p>
        </div>
    </section>

    <section class="site-section site-section--light">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 md:grid-cols-2 xl:grid-cols-3 lg:px-8">
            @forelse ($catalogs as $catalog)
                <article class="site-card--light flex flex-col !rounded-2xl p-7">
                    <div class="flex items-center justify-between">
                        <span class="site-category-badge !text-sm !px-3 !py-1">{{ $catalog->code }}</span>
                        <span class="text-xs font-bold uppercase tracking-widest text-[var(--color-steel)]">PDF</span>
                    </div>
                    <h2 class="font-display mt-8 text-2xl font-bold text-[var(--color-ink)]">{{ $catalog->title }}</h2>
                    <div class="mt-auto pt-8">
                        @if ($catalog->hasPdf())
                            <a
                                href="{{ route('catalog.download', $catalog) }}"
                                target="_blank"
                                rel="noopener"
                                class="site-btn site-btn--dark w-full"
                                title="{{ $catalog->title }} kataloğunu görüntüle"
                            >
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 3v11m0 0 4-4m-4 4-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 17v2a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-2" stroke="currentColor" stroke-linecap="round"/>
                                </svg>
                                Kataloğu Görüntüle
                            </a>
                        @else
                            <button class="site-btn w-full cursor-not-allowed opacity-40" type="button" disabled>Katalog Yakında</button>
                        @endif
                    </div>
                </article>
            @empty
                <div class="site-empty col-span-full">Henüz katalog eklenmemiş.</div>
            @endforelse
        </div>
    </section>

    <section class="site-section site-section--dark">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="site-heading text-2xl text-white sm:text-3xl">Kataloglardaki sistemleri Bingöl’de uyguluyoruz</h2>
            <p class="mt-4 leading-8 text-[var(--color-steel)]">
                Beğendiğiniz profil serisi veya cephe sistemi için ücretsiz keşif ve fiyat teklifi alın.
            </p>
            <a href="{{ url('/#iletisim') }}" class="site-btn site-btn--primary mt-8">Teklif Alın</a>
        </div>
    </section>
@endsection
