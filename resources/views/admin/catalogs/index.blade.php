@extends('admin.layout')

@section('title', 'Kataloglar')
@section('heading', 'Kataloglar')

@section('content')
    <x-admin.page-header title="Katalog Yönetimi" description="Katalog bağlantılarını ekleyin ve sitede yayınlayın.">
        <x-slot:action>
            <a href="{{ route('admin.catalogs.create') }}" class="admin-btn-primary">Katalog Ekle</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="admin-table-wrap">
        <table class="admin-table" data-datatable>
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Kod</th>
                    <th>Bağlantı</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($catalogs as $catalog)
                    <tr>
                        <td class="admin-heading text-sm">{{ $catalog->title }}</td>
                        <td>{{ $catalog->code }}</td>
                        <td>
                            @if ($catalog->hasPdf())
                                <a href="{{ $catalog->pdf_url }}" target="_blank" rel="noopener" class="admin-btn-link">Bağlantıyı aç</a>
                            @else
                                <span class="admin-badge admin-badge--warning">Eksik</span>
                            @endif
                        </td>
                        <td>
                            <div class="admin-table-actions">
                                <a href="{{ route('admin.catalogs.edit', $catalog) }}" class="admin-btn-link">Düzenle</a>
                                <form
                                    method="POST"
                                    action="{{ route('admin.catalogs.destroy', $catalog) }}"
                                    data-confirm-delete
                                    data-confirm-title="Kataloğu sil"
                                    data-confirm-message="“{{ $catalog->title }}” kataloğunu silmek istediğinize emin misiniz? Bu işlem geri alınamaz."
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
