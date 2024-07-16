<?php

// Captcha.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Captcha extends Model
{
    use HasFactory;

    protected $fillable = ['site_key', 'secret_key'];

    // Add any necessary methods or relationships here
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
