@extends('layouts.app')

@php
    $canonical = route('service.show', $slug);

    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $page['service_name'],
        'serviceType' => $page['h1'],
        'description' => $page['description'],
        'url' => $canonical,
        'provider' => ['@id' => url('/').'#business'],
        'areaServed' => array_map(fn ($area) => [
            '@type' => 'City',
            'name' => $area,
        ], config('seo.service_areas')),
    ];

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(fn ($faq) => [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']],
        ], $page['faq']),
    ];
@endphp

@section('title', $page['title'])
@section('meta_description', $page['description'])
@section('meta_keywords', $page['keywords'])
@section('canonical', $canonical)

@push('schema')
    <script type="application/ld+json">{!! json_encode($serviceSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@section('content')
    <section class="site-page-hero site-metal-gradient relative">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[
                ['label' => 'Hizmetlerimiz', 'url' => route('service.show', array_key_first(config('seo-services')))],
                ['label' => $page['nav'], 'url' => $canonical],
            ]" />

            <p class="site-eyebrow mt-8">{{ $page['eyebrow'] }}</p>
            <h1 class="site-heading site-heading--hero mt-5 max-w-3xl text-4xl text-white sm:text-5xl">
                {{ $page['h1'] }}
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-[var(--color-steel)]">
                {{ $page['lead'] }}
            </p>
            <div class="mt-9 flex flex-col gap-4 sm:flex-row">
                <a href="{{ url('/#iletisim') }}" class="site-btn site-btn--primary">Ücretsiz Keşif Talebi</a>
                <a href="tel:{{ config('seo.phone_link') }}" class="site-btn site-btn--ghost">{{ config('seo.phone') }}</a>
            </div>
        </div>
    </section>

    <section class="site-section site-section--light">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-[1.4fr_1fr] lg:px-8">
            <div class="space-y-6 text-base leading-8 text-[#64748b]">
                @foreach ($page['intro'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach

                @foreach ($page['sections'] as $section)
                    <div class="pt-6">
                        <h2 class="site-heading text-2xl text-[var(--color-ink)] sm:text-3xl">{{ $section['heading'] }}</h2>
                        @foreach ($section['body'] as $paragraph)
                            <p class="mt-5">{{ $paragraph }}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <aside class="lg:sticky lg:top-28 lg:self-start">
                <div class="site-value-card">
                    <h2 class="site-subheading text-lg text-[var(--color-ink)]">Kapsam ve seçenekler</h2>
                    <ul class="site-check-list mt-5">
                        @foreach ($page['features'] as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="site-value-card mt-6">
                    <h2 class="site-subheading text-lg text-[var(--color-ink)]">Hizmet bölgelerimiz</h2>
                    <p class="mt-4 text-sm leading-7 text-[#64748b]">
                        {{ implode(', ', config('seo.service_areas')) }} ve çevre beldeler. Keşif ve ölçü hizmetimiz ücretsizdir.
                    </p>
                    <a href="{{ url('/#iletisim') }}" class="site-btn site-btn--dark mt-6 w-full">Teklif Alın</a>
                </div>
            </aside>
        </div>
    </section>

    <section class="site-section site-section--dark">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="site-eyebrow mx-auto">Sıkça Sorulan Sorular</p>
                <h2 class="site-heading mt-4 text-3xl text-white sm:text-4xl">{{ $page['nav'] }} hakkında merak edilenler</h2>
            </div>

            <div class="site-faq mt-12">
                @foreach ($page['faq'] as $index => $faq)
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

    @if (! empty($related))
        <section class="site-section site-section--light">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <p class="site-eyebrow !text-[var(--color-copper)]">Diğer Hizmetlerimiz</p>
                <h2 class="site-heading mt-4 text-3xl text-[var(--color-ink)] sm:text-4xl">Bunlarla birlikte sıkça uygulanan çözümler</h2>

                <div class="mt-10 grid gap-6 md:grid-cols-3">
                    @foreach ($related as $relatedSlug => $relatedPage)
                        <a href="{{ route('service.show', $relatedSlug) }}" class="site-value-card block transition">
                            <h3 class="site-subheading text-lg text-[var(--color-ink)]">{{ $relatedPage['h1'] }}</h3>
                            <p class="mt-3 text-sm leading-7 text-[#64748b]">{{ $relatedPage['lead'] }}</p>
                            <span class="mt-5 inline-block text-sm font-semibold text-[var(--color-copper)]">Detayları görün →</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="site-section site-metal-gradient relative">
        <div class="absolute inset-0 site-metal-shine pointer-events-none"></div>
        <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="site-heading text-2xl text-white sm:text-3xl">{{ $page['h1'] }} için ücretsiz keşif</h2>
            <p class="mt-4 leading-8 text-[var(--color-steel)]">
                Bingöl Merkez ve çevre ilçelerde yerinde keşif yapıp ölçüye dayalı net teklif hazırlıyoruz.
            </p>
            <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ url('/#iletisim') }}" class="site-btn site-btn--primary">Teklif Formu</a>
                <a href="tel:{{ config('seo.phone_link') }}" class="site-btn site-btn--ghost">{{ config('seo.phone') }}</a>
            </div>
        </div>
    </section>
@endsection
