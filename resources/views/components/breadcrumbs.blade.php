@props(['items' => []])

@php
    $trail = array_merge([['label' => 'Ana Sayfa', 'url' => url('/')]], $items);

    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [],
    ];

    foreach ($trail as $index => $crumb) {
        $entry = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $crumb['label'],
        ];

        if (!empty($crumb['url'])) {
            $entry['item'] = $crumb['url'];
        }

        $breadcrumbSchema['itemListElement'][] = $entry;
    }
@endphp

<nav class="site-breadcrumbs" aria-label="Sayfa yolu">
    <ol>
        @foreach ($trail as $index => $crumb)
            <li>
                @if (!empty($crumb['url']) && $index < count($trail) - 1)
                    <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                    <span aria-hidden="true">/</span>
                @else
                    <span aria-current="page">{{ $crumb['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>

@push('schema')
    <script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush
