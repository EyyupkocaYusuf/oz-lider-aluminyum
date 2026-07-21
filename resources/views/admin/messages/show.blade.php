@extends('admin.layout')

@section('title', 'Mesaj Detayı')
@section('heading', 'Mesaj Detayı')

@section('content')
    <x-admin.page-header
        title="Mesaj Detayı"
        description="Teklif talebinin tüm bilgileri."
    >
        <x-slot:action>
            <a href="{{ route('admin.messages.index') }}" class="admin-btn-secondary">Listeye Dön</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="admin-form-card !max-w-3xl space-y-5">
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <p class="admin-label">Ad Soyad</p>
                <p class="admin-heading text-base">{{ $message->name }}</p>
            </div>
            <div>
                <p class="admin-label">Telefon</p>
                <p>
                    <a href="tel:{{ $message->phone }}" class="admin-btn-link">{{ $message->phone }}</a>
                </p>
            </div>
            <div>
                <p class="admin-label">E-posta</p>
                <p>
                    <a href="mailto:{{ $message->email }}" class="admin-btn-link">{{ $message->email }}</a>
                </p>
            </div>
            <div>
                <p class="admin-label">Tarih</p>
                <p class="admin-text-muted">{{ $message->created_at->format('d.m.Y H:i') }}</p>
            </div>
        </div>

        <div>
            <p class="admin-label">Mesaj</p>
            <div class="rounded-xl border border-[rgba(200,208,218,0.55)] bg-[var(--color-mist)] p-4 text-sm leading-7 text-[var(--color-charcoal)] whitespace-pre-line">
                {{ $message->message }}
            </div>
        </div>

        <div class="admin-form-actions">
            <form
                method="POST"
                action="{{ route('admin.messages.destroy', $message) }}"
                data-confirm-delete
                data-confirm-title="Mesajı sil"
                data-confirm-message="Bu mesajı silmek istediğinize emin misiniz?"
            >
                @csrf
                @method('DELETE')
                <button type="submit" class="admin-btn-danger">Mesajı Sil</button>
            </form>
        </div>
    </div>
@endsection
