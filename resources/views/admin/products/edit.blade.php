@extends('admin.layout')

@section('title', 'Ürün Düzenle')
@section('heading', 'Ürün Düzenle')

@section('content')
    <x-admin.page-header title="Ürünü Düzenle" description="Ürün bilgilerini güncelleyin ve kaydedin." />

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.products._form', ['product' => $product])
    </form>
@endsection
