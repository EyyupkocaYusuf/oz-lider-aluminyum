@extends('admin.layout')

@section('title', 'Mesajlar')
@section('heading', 'Mesajlar')

@section('content')
    <x-admin.page-header
        title="Teklif / İletişim Mesajları"
        description="Siteden gelen teklif taleplerini buradan görüntüleyin."
    />

    <div class="admin-table-wrap">
        <table class="admin-table" data-datatable>
            <thead>
                <tr>
                    <th>Ad Soyad</th>
                    <th>Telefon</th>
                    <th>E-posta</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td class="admin-heading text-sm">{{ $message->name }}</td>
                        <td>{{ $message->phone }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <span @class(['admin-badge', 'admin-badge--warning' => ! $message->is_read, 'admin-badge--success' => $message->is_read])>
                                {{ $message->is_read ? 'Okundu' : 'Yeni' }}
                            </span>
                        </td>
                        <td>
                            <div class="admin-table-actions">
                                <a href="{{ route('admin.messages.show', $message) }}" class="admin-btn-link">Görüntüle</a>
                                <form
                                    method="POST"
                                    action="{{ route('admin.messages.destroy', $message) }}"
                                    data-confirm-delete
                                    data-confirm-title="Mesajı sil"
                                    data-confirm-message="“{{ $message->name }}” adlı kişinin mesajını silmek istediğinize emin misiniz?"
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
