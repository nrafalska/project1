<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Визначення таблиці, яку модель представляє
    protected $table = 'products';

    // Визначення полів, які можна масово призначати
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    // Властивості, які слід приховати при серіалізації до JSON
    protected $hidden = [];

    // Поля, які слід перетворювати до певних типів даних
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer'
    ];

    // Приклад визначення відносини з іншою моделлю (якщо потрібно)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Додаткові методи моделі (приклад)
    public function getPriceFormattedAttribute()
    {
        return '$' . number_format($this->price, 2);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function prices()
    {
        return $this->hasMany(Price::class); // Assuming your price model is named 'Price'
    }

}
