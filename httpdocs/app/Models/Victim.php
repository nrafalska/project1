<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'base_url', 'status', 'parser_script'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
