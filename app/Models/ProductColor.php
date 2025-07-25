<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $fillable = ['name', 'description', 'hex_code'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
