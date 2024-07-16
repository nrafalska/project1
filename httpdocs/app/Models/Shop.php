<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['name', 'website_url'];

    // A shop can have many prices associated with different products
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parsers()
    {
        return $this->hasMany(Parser::class);
    }

    public function captchas()
    {
        return $this->hasMany(Captcha::class);
    }
}

