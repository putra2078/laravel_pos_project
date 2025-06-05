@extends('layouts.main')

@section('title', 'Form Input Sederhana')

@section('content')
    <div class="row">
          <!-- left column -->
          <div class="col-md">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama Produk">
                  </div>
                  <div class="form-group">
                    <label for="code">SKU Produk</label>
                    <input type="text" class="form-control" name="code" id="code" placeholder="SKU Produk">
                  </div>
                  <div class="form-group">
                    <label for="category">Kategori</label>
                    <input type="text" class="form-control" name="category" id="category" placeholder="Kategori Produk">
                  </div>
                  <div class="form-group">
                    <label for="stock">Stok Produk</label>
                    <input type="text" class="form-control" name="stock" id="stock" placeholder="Stok Produk">
                  </div>
                  <div class="form-group">
                    <label for="buy_price">Harga Beli</label>
                    <input type="text" class="form-control" name="buy_price" id="buy_price" placeholder="Harga Beli">
                  </div>
                  <div class="form-group">
                    <label for="sell_price">Harga Jual</label>
                    <input type="text" class="form-control" name="sell_price" id="sell_price" placeholder="Harga Jual">
                  </div>
                  <div class="form-group">
                    <label for="image">Gambar Produk</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
@endsection