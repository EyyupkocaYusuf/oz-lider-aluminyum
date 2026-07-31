@extends('admin.layout')

@section('title', 'Katalog Ekle')
@section('heading', 'Katalog Ekle')

@section('content')
    <x-admin.page-header title="Yeni Katalog" description="Katalog bağlantısı ve bilgilerini girerek yeni katalog oluşturun." />

    <form method="POST" action="{{ route('admin.catalogs.store') }}">
        @csrf
        @include('admin.catalogs._form')
    </form>
@endsection
