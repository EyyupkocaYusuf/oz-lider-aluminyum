@php
    $seoBrand = config('seo.brand');
    $seoTitle = trim($__env->yieldContent('title', config('seo.default_title')));
    $seoDescription = trim($__env->yieldContent('meta_description', config('seo.default_description')));
    $seoKeywords = trim($__env->yieldContent('meta_keywords', implode(', ', config('seo.default_keywords'))));
    $seoRobots = trim($__env->yieldContent('meta_robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'));
    $seoCanonical = trim($__env->yieldContent('canonical', url()->current()));
    $seoImage = trim($__env->yieldContent('og_image', asset(config('seo.og_image'))));
    $seoAddress = config('seo.address');
    $seoGeo = config('seo.geo');

    $organizationSchema = [
        '@context' => 'https://schema.org',
        '@type' => ['LocalBusiness', 'HomeAndConstructionBusiness'],
        '@id' => url('/') . '#business',
        'name' => $seoBrand,
        'legalName' => config('seo.legal_name'),
        'description' => config('seo.default_description'),
        'url' => url('/'),
        'image' => asset(config('seo.og_image')),
        'telephone' => config('seo.phone_link'),
        'email' => config('seo.email'),
        'foundingDate' => config('seo.founding_year'),
        'priceRange' => '₺₺',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $seoAddress['street'],
            'addressLocality' => $seoAddress['locality'],
            'addressRegion' => $seoAddress['region'],
            'postalCode' => $seoAddress['postal_code'],
            'addressCountry' => $seoAddress['country'],
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => $seoGeo['latitude'],
            'longitude' => $seoGeo['longitude'],
        ],
        'areaServed' => array_map(fn ($area) => [
            '@type' => 'City',
            'name' => $area,
        ], config('seo.service_areas')),
        'openingHoursSpecification' => array_map(fn ($hours) => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => $hours['days'],
            'opens' => $hours['opens'],
            'closes' => $hours['closes'],
        ], config('seo.opening_hours')),
        'knowsAbout' => config('seo.default_keywords'),
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => 'Alüminyum Sistem Çözümleri',
            'itemListElement' => array_map(fn ($service) => [
                '@type' => 'Offer',
                'itemOffered' => ['@type' => 'Service', 'name' => $service],
            ], [
                'Alüminyum Kapı ve Pencere Sistemleri',
                'Giydirme Cephe Sistemleri',
                'Kompozit Cephe Kaplama',
                'Isı Yalıtımlı Alüminyum Doğrama',
                'Sürme ve Katlanır Sistemler',
                'Alüminyum Korkuluk ve Küpeşte',
            ]),
        ],
    ];

    if (!empty(config('seo.social'))) {
        $organizationSchema['sameAs'] = array_values(config('seo.social'));
    }

    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => url('/') . '#website',
        'name' => $seoBrand,
        'url' => url('/'),
        'inLanguage' => 'tr-TR',
        'publisher' => ['@id' => url('/') . '#business'],
    ];

    $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
@endphp

<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<meta name="keywords" content="{{ $seoKeywords }}">
<meta name="robots" content="{{ $seoRobots }}">
<meta name="googlebot" content="{{ $seoRobots }}">
<meta name="author" content="{{ $seoBrand }}">
<meta name="publisher" content="{{ $seoBrand }}">
<meta name="theme-color" content="#0a0d12">
<link rel="canonical" href="{{ $seoCanonical }}">

<meta name="geo.region" content="TR-12">
<meta name="geo.placename" content="{{ $seoAddress['locality'] }}">
<meta name="geo.position" content="{{ $seoGeo['latitude'] }};{{ $seoGeo['longitude'] }}">
<meta name="ICBM" content="{{ $seoGeo['latitude'] }}, {{ $seoGeo['longitude'] }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $seoBrand }}">
<meta property="og:locale" content="tr_TR">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoCanonical }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:image:alt" content="{{ $seoBrand }} — Bingöl alüminyum kapı, pencere ve cephe sistemleri">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">

<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">

@if (config('seo.google_site_verification'))
<meta name="google-site-verification" content="{{ config('seo.google_site_verification') }}">
@endif

<script type="application/ld+json">{!! json_encode($organizationSchema, $jsonFlags) !!}</script>
<script type="application/ld+json">{!! json_encode($websiteSchema, $jsonFlags) !!}</script>
@stack('schema')
