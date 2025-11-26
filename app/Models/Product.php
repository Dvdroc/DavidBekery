<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'production_time_estimate',
        'is_active',
    ];

    public function closures()
    {
        return $this->hasMany(ProductClosure::class);
    }


    public function isClosedOn($date)
    {
        return $this->closures()->where('date', $date)->exists();
    }
}