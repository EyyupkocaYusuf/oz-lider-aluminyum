@extends('admin.layout')

@section('title', 'Ürünler')
@section('heading', 'Ürünler')

@section('content')
    <x-admin.page-header title="Ürün Yönetimi" description="Ön yüzde listelenen ürünleri kategori ve görselleriyle yönetin.">
        <x-slot:action>
            <a href="{{ route('admin.products.create') }}" class="admin-btn-primary">Ürün Ekle</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="admin-table-wrap">
        <table class="admin-table" data-datatable>
            <thead>
                <tr>
                    <th>Ürün</th>
                    <th>Kategori</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                @if ($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="h-12 w-12 rounded-xl object-cover ring-1 ring-[var(--color-silver)]/40">
                                @else
                                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[var(--color-mist)] text-xs font-bold admin-text-muted">—</div>
                                @endif
                                <div>
                                    <p class="admin-heading text-sm">{{ $product->title }}</p>
                                    @if ($product->is_featured)
                                        <span class="admin-text-accent text-xs">Ana sayfada</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{ $product->category?->name ?? '—' }}</td>
                        <td>
                            <span @class(['admin-badge', 'admin-badge--success' => $product->is_active, 'admin-badge--muted' => ! $product->is_active])>
                                {{ $product->is_active ? 'Aktif' : 'Pasif' }}
                            </span>
                        </td>
                        <td>
                            <div class="admin-table-actions">
                                <a href="{{ route('admin.products.edit', $product) }}" class="admin-btn-link">Düzenle</a>
                                <form
                                    method="POST"
                                    action="{{ route('admin.products.destroy', $product) }}"
                                    data-confirm-delete
                                    data-confirm-title="Ürünü sil"
                                    data-confirm-message="“{{ $product->title }}” ürününü silmek istediğinize emin misiniz? Bu işlem geri alınamaz."
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn-danger">Sil</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
