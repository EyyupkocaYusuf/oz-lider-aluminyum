@extends('admin.layout')

@section('title', 'Kategoriler')
@section('heading', 'Kategoriler')

@section('content')
    <x-admin.page-header
        title="Kategori Yönetimi"
        description="Ürün ve katalog eklerken kullanılacak kategorileri düzenleyin."
    >
        <x-slot:action>
            <a href="{{ route('admin.categories.create') }}" class="admin-btn-primary">Kategori Ekle</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="admin-table-wrap">
        <table class="admin-table" data-datatable>
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Ürün Sayısı</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="admin-heading text-sm">{{ $category->name }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>
                            <span @class(['admin-badge', 'admin-badge--success' => $category->is_active, 'admin-badge--muted' => ! $category->is_active])>
                                {{ $category->is_active ? 'Aktif' : 'Pasif' }}
                            </span>
                        </td>
                        <td>
                            <div class="admin-table-actions">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="admin-btn-link">Düzenle</a>
                                <form
                                    method="POST"
                                    action="{{ route('admin.categories.destroy', $category) }}"
                                    data-confirm-delete
                                    data-confirm-title="Kategoriyi sil"
                                    data-confirm-message="“{{ $category->name }}” kategorisini silmek istediğinize emin misiniz? Bu işlem geri alınamaz."
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
