@extends('admin.layout')

@section('title', 'Kategori Ekle')
@section('heading', 'Kategori Ekle')

@section('content')
    <x-admin.page-header title="Yeni Kategori" description="Ürünleri gruplamak için yeni bir kategori oluşturun." />

    <form method="POST" action="{{ route('admin.categories.store') }}" class="admin-form-card max-w-xl space-y-5">
        @csrf
        @include('admin.categories._form')
        <div class="admin-form-actions !border-t-0 !pt-0">
            <a href="{{ route('admin.categories.index') }}" class="admin-btn-secondary">İptal</a>
            <button type="submit" class="admin-btn-primary">Kategori Kaydet</button>
        </div>
    </form>
@endsection
