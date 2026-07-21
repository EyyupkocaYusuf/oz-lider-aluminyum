@extends('admin.layout')

@section('title', 'Katalog Düzenle')
@section('heading', 'Katalog Düzenle')

@section('content')
    <x-admin.page-header title="Kataloğu Düzenle" description="Katalog bilgilerini ve PDF dosyasını güncelleyin." />

    <form method="POST" action="{{ route('admin.catalogs.update', $catalog) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.catalogs._form', ['catalog' => $catalog])
    </form>
@endsection
