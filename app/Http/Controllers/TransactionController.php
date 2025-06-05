<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{

    public function exportExcel()
{
    return Excel::download(new TransactionExport, 'transaction_view.xlsx');
}
    public function index()
    {
        $products = Product::all();
        return view('transaction', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'products' => 'required',
            'metode' => 'required|string',
            'diskon' => 'nullable|numeric|min:0'
        ]);

        // Validasi dan simpan transaksi
        $customerName = $request->input('customer_name');
        $total = $request->input('total');
        $products = json_decode($request->input('products'), true);
        $metode = $request->input('metode');
        $diskon = $request->input('diskon');

        // Simpan transaksi utama
        $transaction = Transaction::create([
            'customer_name' => $customerName,
            'total' => $total,
            'payment_method' => $metode,
            'discount' => $diskon ?? 0
        ]);

        // Simpan detail produk (relasi many to many jika ada)
        foreach ($products as $product) {
            $transaction->products()->attach($product['id'], [
                'quantity' => $product['quantity']
            ]);
        }

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan.');
    }
    
    public function history()
    {
        $transactions = Transaction::with('products')->get();
        return view('transaction_history', compact('transactions'));
    }

    public function reportProfit(Request $request)
    {
        $query = Transaction::with('products');

        // Filter berdasarkan rentang tanggal jika diberikan
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if ($startDate && $endDate) {
            $query->whereDate('created_at', '>=', $startDate)
                  ->whereDate('created_at', '<=', $endDate);
        }

        $transactions = $query->get();
        return view('report_profit', compact('transactions'));
    }

    public function chartTransactions(Request $request)
    {
        $query = Transaction::with('products');

        // Filter berdasarkan rentang tanggal jika diberikan
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if ($startDate && $endDate) {
            // Pastikan format tanggal sesuai dengan format database (Y-m-d)
            $query->whereDate('created_at', '>=', $startDate)
                  ->whereDate('created_at', '<=', $endDate);
        }

        $transactions = $query->get();
        $data = [];

        foreach ($transactions as $transaction) {
            $data[] = [
                'id' => $transaction->id,
                'customer_name' => $transaction->customer_name,
                'total' => $transaction->total,
                'discount' => $transaction->discount,
                'payment_method' => $transaction->payment_method,
                'created_at' => $transaction->created_at ? $transaction->created_at->format('d/m/Y') : null,
                'updated_at' => $transaction->updated_at ? $transaction->updated_at->format('d/m/Y') : null,
                'products' => $transaction->products->map(function ($product) {
                    return [
                        'name' => $product->name,
                        'quantity' => $product->pivot->quantity
                    ];
                })
            ];
        }

        return response()->json($data);
    }

    // Hapus relasi produk pada tabel pivot sebelum menghapus transaksi
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        // Detach all related products from the pivot table
        $transaction->products()->detach();

        // Delete the transaction
        $transaction->delete();

        return redirect()->back()->with('success', 'Transaksi dan detail produk berhasil dihapus.');
    }

}

