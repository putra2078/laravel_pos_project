@extends('layouts.main')

@section('title', 'Product List')

@section('content')
{{-- <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Id Produk</th>
                <th>Nama</th>
                <th>Kode</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $data)
                <tr style="text-align: center;">
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->code }}</td>
                    <td>{{ $data->category }}</td>
                    <td>{{ $data->stock }}</td>
                    <td>{{ $data->buy_price }}</td>
                    <td><img src="{{ asset( $data->image) }}" alt="Gambar Produk" width="100"></td>
                </tr>
            @endforeach
    </table> --}}
    <div class="row">
      <div class="col-md">
      <div class="card">
        <div class="card-header">
        <h3 class="card-title">Produk</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

        {{-- Filter Form --}}
        <form method="GET" action="{{ url()->current() }}" class="mb-3">
        <div class="row">
        <div class="col-md-4">
          <select name="category" class="form-control" onchange="this.form.submit()">
          <option value="">-- Semua Kategori --</option>
          @php
          $categories = \App\Models\Product::select('category')->distinct()->pluck('category');
          @endphp
          @foreach($categories as $cat)
          <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
          @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary">Filter</button>
          <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
        </div>
        </div>
        </form>
        {{-- End Filter Form --}}

        <table class="table table-bordered">
        <thead>
        <tr style="text-align: center">
          <th style="width: 30px">Id Produk</th>
          <th>Nama Produk</th>
          <th>SKU Produk</th>
          <th>Kategori</th>
          <th>Stok</th>
          <th>Harga Beli</th>
          <th>Harga Jual</th>
          <th>Gambar</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($product as $data)
        <tr style="text-align: center">
          <td>{{ $data->id }}</td>
          <td>{{ $data->name }}</td>
          <td>{{ $data->code }}</td>
          <td>{{ $data->category }}</td>
          <td>{{ $data->stock }}</td>
          <td>{{ $data->buy_price }}</td>
          <td>{{ $data->sell_price }}</td>
          <td><img src="{{ asset( $data->image) }}" alt="Gambar Produk" width="100"></td>
          <td>
          <a href="/edit_product/{{ $data->id }}" class="btn btn-primary">Edit</a>
        </tr>
        @endforeach
        </tbody>
        </table>
        {{-- Pagination --}}
        <div class="mt-3 d-flex justify-content-center">
        {{-- {{ $product->withQueryString()->links() }} --}}
        </div>
        </div>
          <!-- /.card-body -->
          {{-- <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
          </ul>
          </div> --}}
        </div>
            <!-- /.card -->
@endsection