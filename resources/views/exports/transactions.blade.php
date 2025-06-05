<table class="table table-bordered">
                    <thead>
                        <tr style="text-align: center">
                            <th style="width: 30px">Id Transaction</th>
                            <th>Tanggal</th>
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