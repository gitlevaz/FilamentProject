<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
        protected $fillable = ['name', 'api_unique_number'];

    public function assignments()
    {
        return $this->hasMany(TypeAssignment::class, 'type_id');
    }
}
