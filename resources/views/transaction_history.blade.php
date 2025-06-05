@extends('layouts.main')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="row">
        <div class="col-md">
            <div class="card">
            <div class="card-header">
            <h3 class="card-title">Laporan Transaksi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                <thead>
                    <tr style="text-align: center">
                    <th style="width: 30px">Id Transaction</th>
                    <th>Tanggal</th>
                    <th>Metode Bayar</th>
                    <th>Total</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $trx)
                    <tr style="text-align: center">
                    <td>{{ $trx->id }}</td>
                    <td>{{ $trx->created_at }}</td>
                    <td>{{ $trx->payment_method }}</td>
                    <td>{{ $trx->total }}</td>
                    <td>
                        <form action="{{ route('transaction.delete', $trx->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
@endsection