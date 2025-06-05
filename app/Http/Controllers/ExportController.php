<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportReceipt()
{
    $data = [
        'nama_pelanggan' => 'Putra Santuy',
        'tanggal' => now(),
        'produk' => [
            ['nama' => 'Indomie Goreng', 'harga' => 3500, 'qty' => 2],
            ['nama' => 'Kopi Hitam', 'harga' => 5000, 'qty' => 1],
        ]
    ];

    return Pdf::loadView('receipt', $data)
              ->setPaper('A6')
              ->download('nota_transaksi.pdf');
}
}
