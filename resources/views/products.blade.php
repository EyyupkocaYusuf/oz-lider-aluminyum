@extends('layouts.app')

@section('title', 'Ürünlerimiz | Öz Lider Alüminyum')

@section('content')
    <section class="site-page-hero site-metal-gradient relative">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="site-eyebrow">Ürünlerimiz</p>
            <h1 class="site-heading site-heading--hero mt-5 max-w-3xl text-4xl text-white sm:text-5xl">
                Projelerinize özel alüminyum sistem çözümleri
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-[var(--color-steel)]">
                Cephe sistemlerinden standart profillere, geniş ürün yelpazemizi keşfedin ve projeniz için teklif alın.
            </p>
        </div>
    </section>

    <section class="site-section site-section--light">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($categories->isNotEmpty())
                <div class="mb-10 flex flex-wrap gap-2">
                    <a href="{{ route('products.index') }}" class="site-filter-pill {{ ! $activeCategory ? 'is-active' : '' }}">Tümü</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('products.index', ['kategori' => $category->slug]) }}" class="site-filter-pill {{ $activeCategory?->id === $category->id ? 'is-active' : '' }}">
                            {{ $category->name }}
                            <span class="opacity-60">({{ $category->products_count }})</span>
                        </a>
                    @endforeach
                </div>
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
                                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="flex h-full items-center justify-center">
                                        <span class="font-display text-4xl font-extrabold text-[var(--color-steel)]/25">ÖL</span>
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
@endsection
