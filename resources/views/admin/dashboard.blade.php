@extends('admin.layout')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <div class="mb-8">
        <p class="admin-eyebrow">Genel Bakış</p>
        <h1 class="admin-heading mt-2 text-3xl">Dashboard</h1>
        <p class="mt-2 text-sm admin-text-muted">Site içeriklerinizin özet durumu.</p>
    </div>

    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <article class="admin-stat-card" style="--stat-glow: rgba(201, 169, 98, 0.14);">
            <div class="relative flex items-start justify-between gap-3">
                <div>
                    <p class="text-sm font-semibold admin-text-muted">Kategoriler</p>
                    <p class="admin-heading mt-2 text-4xl">{{ $categoryCount }}</p>
                </div>
                <span class="admin-stat-card__icon">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h7V4H4v3Zm9 0h7V4h-7v3ZM4 14h7v-3H4v3Zm9 0h7v-3h-7v3ZM4 21h7v-3H4v3Zm9 0h7v-3h-7v3Z" stroke="currentColor" stroke-width="1.7"/></svg>
                </span>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="admin-btn-link relative mt-5 inline-flex">Yönet →</a>
        </article>

        <article class="admin-stat-card" style="--stat-glow: rgba(166, 124, 82, 0.14);">
            <div class="relative flex items-start justify-between gap-3">
                <div>
                    <p class="text-sm font-semibold admin-text-muted">Ürünler</p>
                    <p class="admin-heading mt-2 text-4xl">{{ $productCount }}</p>
                </div>
                <span class="admin-stat-card__icon">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 8h10l1 12H6L7 8ZM9 8V6a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                </span>
            </div>
            <a href="{{ route('admin.products.index') }}" class="admin-btn-link relative mt-5 inline-flex">Yönet →</a>
        </article>

        <article class="admin-stat-card" style="--stat-glow: rgba(138, 150, 168, 0.14);">
            <div class="relative flex items-start justify-between gap-3">
                <div>
                    <p class="text-sm font-semibold admin-text-muted">Kataloglar</p>
                    <p class="admin-heading mt-2 text-4xl">{{ $catalogCount }}</p>
                </div>
                <span class="admin-stat-card__icon">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 4h9l3 3v13H6V4Zm9 0v3h3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                </span>
            </div>
            <a href="{{ route('admin.catalogs.index') }}" class="admin-btn-link relative mt-5 inline-flex">Yönet →</a>
        </article>

        <article class="admin-stat-card" style="--stat-glow: rgba(201, 169, 98, 0.18);">
            <div class="relative flex items-start justify-between gap-3">
                <div>
                    <p class="text-sm font-semibold admin-text-muted">Mesajlar</p>
                    <p class="admin-heading mt-2 text-4xl">{{ $messageCount }}</p>
                    @if ($unreadMessageCount > 0)
                        <p class="mt-1 text-xs font-semibold text-[var(--color-copper)]">{{ $unreadMessageCount }} yeni</p>
                    @endif
                </div>
                <span class="admin-stat-card__icon">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 6h16v12H4V6Zm0 0 8 6 8-6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="admin-btn-link relative mt-5 inline-flex">Yönet →</a>
        </article>
    </div>

    <div class="admin-card mt-8 p-6 sm:p-7">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="admin-heading text-lg">Hızlı İşlemler</h2>
                <p class="mt-1 text-sm admin-text-muted">Sık kullanılan içerik ekleme işlemlerine tek tıkla ulaşın.</p>
            </div>
        </div>
        <div class="mt-5 flex flex-wrap gap-3">
            <a href="{{ route('admin.categories.create') }}" class="admin-btn-primary">Kategori Ekle</a>
            <a href="{{ route('admin.products.create') }}" class="admin-btn-primary">Ürün Ekle</a>
            <a href="{{ route('admin.catalogs.create') }}" class="admin-btn-primary">Katalog Ekle</a>
        </div>
    </div>
@endsection
