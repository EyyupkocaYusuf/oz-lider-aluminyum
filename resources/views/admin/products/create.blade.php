@extends('admin.layout')

@section('title', 'Ürün Ekle')
@section('heading', 'Ürün Ekle')

@section('content')
    <x-admin.page-header title="Yeni Ürün" description="Kategori, görsel ve yayın ayarlarını doldurarak ürünü siteye ekleyin." />

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.products._form')
    </form>
@endsection
