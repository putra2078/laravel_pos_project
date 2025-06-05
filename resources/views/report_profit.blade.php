@extends('layouts.main')

@section('title', 'Riwayat Transaksi')

@section('content')
@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

@if ($user && $user->role === 'user')
    <script>
        alert('kamu tidak punya akses ke page ini');
        window.location.href = "{{ url('/') }}";
    </script>
    @php exit; @endphp
@elseif ($user && $user->role === 'admin')
    {{-- lanjut ke halaman --}}
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @php exit; @endphp
@endif

<div class="row mb-3">
    <div class="col-md">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Transaksi</h3>
                <div class="col-md- d-flex align-items-center justify-content-end">
                    <a href="{{ route('export.excel') }}" class="btn btn-success">Export</a>
                </div>
            </div>
            <!-- Filter Form -->
            <div class="card-body">
                <form method="GET" action="{{ route('report.profit') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date">Dari Tanggal</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">Sampai Tanggal</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: center">
                            <th style="width: 30px">Id Transaction</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggan</th>
                            <th>Produk</th>
                            <th>Metode Bayar</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                            <th>Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $trx)
                        <tr style="text-align: center">
                            <td>{{ $trx->id }}</td>
                            <td>{{ $trx->created_at }}</td>
                            <td>{{ $trx->customer_name }}</td>
                            <td>
                                <ul>
                                    @foreach($trx->products as $p)
                                        <li>{{ $p->name }} x{{ $p->pivot->quantity }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $trx->payment_method }}</td>
                            <td>{{ $trx->discount }}</td>
                            <td>{{ $trx->total }}</td>
                            <td>{{ $trx->total - ($trx->total * $trx->discount / 100) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection