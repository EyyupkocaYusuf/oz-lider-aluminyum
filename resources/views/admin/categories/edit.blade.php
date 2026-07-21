@extends('admin.layout')

@section('title', 'Kategori Düzenle')
@section('heading', 'Kategori Düzenle')

@section('content')
    <x-admin.page-header title="Kategoriyi Düzenle" description="Kategori adını ve durumunu güncelleyin." />

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="admin-form-card max-w-xl space-y-5">
        @csrf
        @method('PUT')
        @include('admin.categories._form', ['category' => $category])
        <div class="admin-form-actions !border-t-0 !pt-0">
            <a href="{{ route('admin.categories.index') }}" class="admin-btn-secondary">İptal</a>
            <button type="submit" class="admin-btn-primary">Değişiklikleri Kaydet</button>
        </div>
    </form>
@endsection
