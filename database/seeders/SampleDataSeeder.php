<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categories = [
            [
                'name' => 'Healthy Bowls',
                'slug' => 'healthy-bowls',
                'description' => 'Các món salad healthy cân bằng dinh dưỡng',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Smoothies',
                'slug' => 'smoothies',
                'description' => 'Nước ép và smoothie tươi mát',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Snacks',
                'slug' => 'snacks',
                'description' => 'Các món ăn nhẹ healthy',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create sample products
        $products = [
            [
                'name' => 'Garden Fresh Bowl',
                'slug' => 'garden-fresh-bowl',
                'description' => 'Salad rau củ tươi với sốt balsamic',
                'price' => 85000,
                'calories' => 320,
                'protein' => 12,
                'carb' => 28,
                'fat' => 18,
                'category_id' => 1,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Protein Power Bowl',
                'slug' => 'protein-power-bowl',
                'description' => 'Salad cao protein với ức gà và quinoa',
                'price' => 120000,
                'calories' => 450,
                'protein' => 35,
                'carb' => 32,
                'fat' => 15,
                'category_id' => 1,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Green Detox Smoothie',
                'slug' => 'green-detox-smoothie',
                'description' => 'Smoothie rau xanh detox cơ thể',
                'price' => 55000,
                'calories' => 180,
                'protein' => 8,
                'carb' => 22,
                'fat' => 6,
                'category_id' => 2,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Berry Blast Smoothie',
                'slug' => 'berry-blast-smoothie',
                'description' => 'Smoothie dâu và các loại berry',
                'price' => 60000,
                'calories' => 220,
                'protein' => 10,
                'carb' => 35,
                'fat' => 8,
                'category_id' => 2,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Granola Bar',
                'slug' => 'granola-bar',
                'description' => 'Thanh granola healthy với mật ong',
                'price' => 35000,
                'calories' => 280,
                'protein' => 8,
                'carb' => 42,
                'fat' => 12,
                'category_id' => 3,
                'is_active' => true,
                'sort_order' => 1,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
