<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { text-align: left; padding: 4px; }
        .total { text-align: right; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
    <h3>Struk Belanja</h3>
    <p>Nama: {{ $nama_pelanggan }}</p>
    <p>Tanggal: {{ $tanggal->format('d-m-Y H:i') }}</p>
    
    <table border="1">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($produk as $item)
                <tr>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>Rp {{ number_format($item['harga'] * $item['qty']) }}</td>
                </tr>
                @php $total += $item['harga'] * $item['qty']; @endphp
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: Rp {{ number_format($total) }}</p>
</body>
</html>
