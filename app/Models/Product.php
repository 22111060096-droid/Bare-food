<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'calories',
        'protein',
        'carb',
        'fat',
        'fiber',
        'sugar',
        'is_active',
        'is_featured',
        'is_vegetarian',
        'goal_tag',
        'image_url',
        'sort_order',
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
        'is_featured' => 'boolean',
        'is_vegetarian' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function toppings()
    {
        return $this->belongsToMany(Topping::class)->withPivot([
            'extra_price',
            'extra_calories',
        ]);
    }
}

