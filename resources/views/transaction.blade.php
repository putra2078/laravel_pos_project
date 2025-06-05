@extends('layouts.main')

@section('title', 'Transaksi')

@section('content')
    <div class="row">
        <!-- Kiri: Daftar Produk -->
        <div class="col-md-8">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->sell_price }}">
                            <div class="card-body text-center">
                                <img src="{{ $product->image }}" alt="Gambar Produk" width="100">
                                <h5>{{ $product->name }}</h5>
                                <p>Rp {{ number_format($product->sell_price) }}</p>
                                <button class="btn btn-sm btn-success add-product">Pilih</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Kanan: Selected Product dan Transaksi -->
        <div class="col-md-4">
            <form id="transaksiForm" method="POST" action="{{ url('/transaction') }}">
                @csrf
                <h4>Keranjang</h4>
                <ul id="selectedProducts" class="list-group mb-3"></ul>

                <div class="mb-2">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" value="Pelanggan">
                </div>

                <div class="mb-2">
                    <label>Diskon (%)</label>
                    <input type="number" name="diskon" id="diskon" class="form-control" value="0">
                </div>

                <div class="mb-2">
                    <label>Metode Pembayaran</label>
                    <select name="metode" class="form-control">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="ewallet">E-Wallet</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label>Total</label>
                    <input type="text" id="totalDisplay" class="form-control" readonly>
                    <input type="hidden" name="total" id="total">
                </div>

                <input type="hidden" name="products" id="productsInput">
                <button type="submit" class="btn btn-primary">Bayar</button>
            </form>
        </div>
    </div>
</div>

<script>
    let selectedProducts = [];

    function updateSelectedList() {
        const list = document.getElementById('selectedProducts');
        const input = document.getElementById('productsInput');
        const totalDisplay = document.getElementById('totalDisplay');
        const totalHidden = document.getElementById('total');

        list.innerHTML = '';
        let total = 0;

        selectedProducts.forEach(prod => {
            const li = document.createElement('li');
            li.classList.add('list-group-item');
            li.innerText = `${prod.name} x${prod.quantity} - Rp${prod.price * prod.quantity}`;
            list.appendChild(li);
            total += prod.price * prod.quantity;
        });

        totalDisplay.value = 'Rp ' + total.toLocaleString();
        totalHidden.value = total;
        input.value = JSON.stringify(selectedProducts);
    }

    document.querySelectorAll('.add-product').forEach(btn => {
        btn.addEventListener('click', function () {
            const card = this.closest('.product-card');
            const id = card.dataset.id;
            const name = card.dataset.name;
            const price = parseInt(card.dataset.price);

            const existing = selectedProducts.find(p => p.id == id);
            if (existing) {
                existing.quantity++;
            } else {
                selectedProducts.push({ id, name, price, quantity: 1 });
            }

            updateSelectedList();
        });
    });
</script>
@endsection