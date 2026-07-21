@props([
    'title',
    'description' => null,
])

<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="admin-eyebrow">Yönetim</p>
        <h2 class="admin-heading mt-2 text-2xl sm:text-3xl">{{ $title }}</h2>
        @if ($description)
            <p class="mt-2 max-w-2xl text-sm leading-6 admin-text-muted">{{ $description }}</p>
        @endif
    </div>
    @isset($action)
        <div class="shrink-0">{{ $action }}</div>
    @endisset
</div>
