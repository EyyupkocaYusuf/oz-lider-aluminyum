@extends('layouts.app')

@section('title', 'Katalog | Öz Lider Alüminyum')

@section('content')
    <section class="site-page-hero site-metal-gradient relative">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="site-eyebrow">Kataloglar</p>
            <h1 class="site-heading site-heading--hero mt-5 max-w-3xl text-4xl text-white sm:text-5xl">
                Teknik kataloglar ve sistem dosyaları
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-[var(--color-steel)]">
                Profil grupları ve sistem detaylarını incelemek için katalog dosyalarımızı indirin.
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
                            <a href="{{ route('catalog.download', $catalog) }}" target="_blank" rel="noopener" class="site-btn site-btn--dark w-full">
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
@endsection
