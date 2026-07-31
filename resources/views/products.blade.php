@extends('layouts.app')

@php
    $pageTitle = $activeCategory
        ? $activeCategory->name.' | Bingöl Alüminyum Sistemleri - Öz Lider Alüminyum'
        : 'Alüminyum Kapı, Pencere ve Cephe Sistemleri | Bingöl - Öz Lider Alüminyum';

    $pageDescription = $activeCategory
        ? (trim((string) $activeCategory->description)
            ?: $activeCategory->name.' ürün grubumuzu inceleyin. Öz Lider Alüminyum, Bingöl Merkez ve çevre ilçelerde alüminyum sistem üretimi, ölçü ve montaj hizmeti sunar.')
        : 'Bingöl’de alüminyum kapı, pencere, giydirme cephe, kompozit cephe kaplama, sürme sistem ve ısı yalıtımlı doğrama ürünlerimizi inceleyin. Öz Lider Alüminyum ile projenize özel çözüm ve ücretsiz teklif.';

    $pageHeading = $activeCategory
        ? $activeCategory->name
        : 'Bingöl’de projelerinize özel alüminyum sistem çözümleri';

    $breadcrumbItems = [['label' => 'Ürünlerimiz', 'url' => route('products.index')]];

    if ($activeCategory) {
        $breadcrumbItems[] = [
            'label' => $activeCategory->name,
            'url' => route('products.index', ['kategori' => $activeCategory->slug]),
        ];
    }

    $productListSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => $pageHeading,
        'itemListElement' => $products->values()->map(fn ($product, $index) => array_filter([
            '@type' => 'ListItem',
            'position' => $index + 1,
            'item' => array_filter([
                '@type' => 'Product',
                'name' => $product->title,
                'image' => $product->image_url,
                'category' => $product->category?->name,
                'brand' => ['@type' => 'Brand', 'name' => config('seo.brand')],
                'url' => route('products.index', $product->category ? ['kategori' => $product->category->slug] : []),
            ]),
        ]))->all(),
    ];
@endphp

@section('title', $pageTitle)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($pageDescription), 300, ''))
@section('meta_keywords', 'Bingöl alüminyum ürünleri, alüminyum kapı Bingöl, alüminyum pencere Bingöl, Bingöl cephe sistemleri, Bingöl kompozit cephe, sürme sistemler, ısı yalıtımlı alüminyum')
@section('canonical', $activeCategory ? route('products.index', ['kategori' => $activeCategory->slug]) : route('products.index'))

@if ($products->isNotEmpty())
    @push('schema')
        <script type="application/ld+json">{!! json_encode($productListSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @endpush
@endif

@section('content')
    <section class="site-page-hero site-metal-gradient relative">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="$breadcrumbItems" />

            <p class="site-eyebrow mt-8">Ürünlerimiz</p>
            <h1 class="site-heading site-heading--hero mt-5 max-w-3xl text-4xl text-white sm:text-5xl">
                {{ $pageHeading }}
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-[var(--color-steel)]">
                {{ $pageDescription }}
            </p>
        </div>
    </section>

    <section class="site-section site-section--light">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($categories->isNotEmpty())
                <nav class="mb-10 flex flex-wrap gap-2" aria-label="Ürün kategorileri">
                    <a href="{{ route('products.index') }}" class="site-filter-pill {{ ! $activeCategory ? 'is-active' : '' }}">Tümü</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('products.index', ['kategori' => $category->slug]) }}" class="site-filter-pill {{ $activeCategory?->id === $category->id ? 'is-active' : '' }}">
                            {{ $category->name }}
                            <span class="opacity-60">({{ $category->products_count }})</span>
                        </a>
                    @endforeach
                </nav>
            @endif

            @if ($products->isEmpty())
                <div class="site-empty">
                    <p class="font-display text-lg font-bold text-[var(--color-ink)]">Bu kategoride henüz ürün bulunmuyor.</p>
                    @if ($activeCategory)
                        <a href="{{ route('products.index') }}" class="site-btn site-btn--dark mt-5">Tüm ürünleri gör</a>
                    @endif
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($products as $product)
                        <article class="site-card--light group overflow-hidden !rounded-2xl">
                            <div class="aspect-[4/3] overflow-hidden bg-[var(--color-mist)]">
                                @if ($product->image_url)
                                    <img
                                        src="{{ $product->image_url }}"
                                        alt="{{ $product->title }}{{ $product->category ? ' - '.$product->category->name : '' }} | Bingöl alüminyum sistemleri"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                @else
                                    <div class="flex h-full items-center justify-center">
                                        <span class="font-display text-4xl font-extrabold text-[var(--color-steel)]/25" aria-hidden="true">ÖL</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <div class="flex items-start justify-between gap-3">
                                    <h2 class="font-display text-xl font-bold text-[var(--color-ink)]">{{ $product->title }}</h2>
                                    @if ($product->category)
                                        <span class="site-category-badge shrink-0">{{ $product->category->name }}</span>
                                    @endif
                                </div>
                                <a class="site-btn site-btn--dark mt-5 w-full" href="{{ url('/#iletisim') }}">Teklif Alın</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="site-section site-section--dark">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="site-heading text-2xl text-white sm:text-3xl">Aradığınız alüminyum sistemi bulamadınız mı?</h2>
            <p class="mt-4 leading-8 text-[var(--color-steel)]">
                Bingöl Merkez ve çevre ilçelerde özel ölçü alüminyum doğrama, giydirme cephe ve kompozit kaplama projeleri üretiyoruz. İhtiyacınızı iletin, size en uygun sistemi birlikte belirleyelim.
            </p>
            <a href="{{ url('/#iletisim') }}" class="site-btn site-btn--primary mt-8">Ücretsiz Keşif Talebi</a>
        </div>
    </section>
@endsection
