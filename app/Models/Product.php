<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category',
        'stock',
        'tax',
        'discount',
        'pay_amount',
        'buy_price',
        'sell_price',
        'image',
    ];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function transactions()
{
    return $this->belongsToMany(Transaction::class)->withPivot('quantity');
}

}
