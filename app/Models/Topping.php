<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'price',
        'calories',
        'protein',
        'carb',
        'fat',
        'fiber',
        'sugar',
        'is_active',
    ];

    protected $casts = [
        'price' => 'integer',
        'calories' => 'integer',
        'protein' => 'integer',
        'carb' => 'integer',
        'fat' => 'integer',
        'fiber' => 'integer',
        'sugar' => 'integer',
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot([
            'extra_price',
            'extra_calories',
        ]);
    }
}

