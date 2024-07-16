<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['product_id', 'shop_id', 'amount', 'currency', 'url', 'timestamp'];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    // A price belongs to one product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // A price is associated with one shop
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
