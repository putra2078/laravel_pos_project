@extends('layouts.main')

@section('title', 'Hasil form input')

@section('content')
    <h2>Hasil Input</h2>
    <p>Nama : {{ $name }}</p>
    <p>Kode : {{ $code }}</p>
    <p>Kategori : {{ $category }}</p>
    <p>Stok : {{ $stock }}</p>
    <p>Harga : {{ $buy_price }}</p>
    <p>Gambar Produk: </p><br><br>
    @if ($image)
        <img src="{{ asset($image) }}" alt="Gambar Produk" width="200">
    @endif
    <a href="/form">Kembali ke Form</a>

@endsection