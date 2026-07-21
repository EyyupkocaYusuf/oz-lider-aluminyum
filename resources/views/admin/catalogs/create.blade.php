@extends('admin.layout')

@section('title', 'Katalog Ekle')
@section('heading', 'Katalog Ekle')

@section('content')
    <x-admin.page-header title="Yeni Katalog" description="PDF dosyası ve katalog bilgilerini girerek yeni katalog oluşturun." />

    <form method="POST" action="{{ route('admin.catalogs.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.catalogs._form')
    </form>
@endsection
