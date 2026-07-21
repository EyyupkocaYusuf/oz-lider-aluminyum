@props([
    'href',
    'active' => false,
    'label',
])

<a href="{{ $href }}" @class(['admin-nav-link', 'admin-nav-link--active' => $active])>
    {{ $slot }}
    <span>{{ $label }}</span>
</a>
