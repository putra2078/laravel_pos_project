<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'customer_name',
        'total',
        'discount',
        'payment_method',
    ];

    public function products()
{
    return $this->belongsToMany(Product::class)->withPivot('quantity');
}
}
