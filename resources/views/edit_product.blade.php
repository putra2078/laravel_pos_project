@extends('layouts.main')

@section('title', 'Edit Produk')

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md">
            <!-- general form elements -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Produk</h3>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/update/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama Produk" value="{{ old('name', $product->name) }}">
                  </div>
                  <div class="form-group">
                    <label for="code">SKU Produk</label>
                    <input type="text" class="form-control" name="code" id="code" placeholder="SKU Produk" value="{{ old('code', $product->code) }}">
                  </div>
                  <div class="form-group">
                    <label for="category">Kategori</label>
                    <input type="text" class="form-control" name="category" id="category" placeholder="Kategori Produk" value="{{ old('category', $product->category) }}">
                  </div>
                  <div class="form-group">
                    <label for="stock">Stok Produk</label>
                    <input type="text" class="form-control" name="stock" id="stock" placeholder="Stok Produk" value="{{ old('stock', $product->stock) }}">
                  </div>
                  <div class="form-group">
                    <label for="buy_price">Harga Beli</label>
                    <input type="text" class="form-control" name="buy_price" id="buy_price" placeholder="Harga Beli" value="{{ old('buy_price', $product->buy_price) }}">
                  </div>
                  <div class="form-group">
                    <label for="sell_price">Harga Jual</label>
                    <input type="text" class="form-control" name="sell_price" id="sell_price" placeholder="Harga Jual" value="{{ old('sell_price', $product->sell_price) }}">
                  </div>
                  <div class="form-group">
                    <label for="image">Gambar Produk</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('image', $product->image) }}">z
                        <label class="custom-file-label custom-file" for="image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Update</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
@endsection