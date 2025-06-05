<?php

namespace App\Exports;

use App\Models\Transaction as ModelsTransaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $transactions = ModelsTransaction::with('products')->get();
        return view('exports.transactions', [
            'transactions' => $transactions
        ]);
    }
}
