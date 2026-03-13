<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $rice = Category::query()->firstOrCreate(
            ['slug' => 'healthy-rice-bowl'],
            ['name' => 'Healthy Rice Bowl', 'description' => 'Cơm gạo lứt, quinoa, protein sạch']
        );

        $salad = Category::query()->firstOrCreate(
            ['slug' => 'salad-bowl'],
            ['name' => 'Salad Bowl', 'description' => 'Nhiều rau xanh, sốt nhẹ, ít calories']
        );

        $grain = Category::query()->firstOrCreate(
            ['slug' => 'grain-bowl'],
            ['name' => 'Grain Bowl', 'description' => 'Ngũ cốc nguyên cám, no lâu, ít đường']
        );

        Product::query()->firstOrCreate(
            ['slug' => 'salmon-poke-bowl'],
            [
                'category_id' => $rice->id,
                'name' => 'Salmon Poke Bowl',
                'description' => 'Cá hồi tươi, gạo lứt, edamame, bơ, rong biển.',
                'price' => 129000,
                'calories' => 430,
                'protein' => 28,
                'carb' => 42,
                'fat' => 14,
                'fiber' => 6,
                'sugar' => 5,
                'is_active' => true,
                'is_featured' => true,
                'is_vegetarian' => false,
                'goal_tag' => 'tăng cơ',
                'sort_order' => 1,
            ]
        );

        Product::query()->firstOrCreate(
            ['slug' => 'green-goddess-salad-bowl'],
            [
                'category_id' => $salad->id,
                'name' => 'Green Goddess Salad Bowl',
                'description' => 'Mix rau xanh, ức gà nướng hoặc đậu gà, sốt yogurt.',
                'price' => 109000,
                'calories' => 360,
                'protein' => 16,
                'carb' => 32,
                'fat' => 12,
                'fiber' => 8,
                'sugar' => 4,
                'is_active' => true,
                'is_featured' => true,
                'is_vegetarian' => false,
                'goal_tag' => 'giảm cân',
                'sort_order' => 2,
            ]
        );

        Product::query()->firstOrCreate(
            ['slug' => 'quinoa-power-grain-bowl'],
            [
                'category_id' => $grain->id,
                'name' => 'Quinoa Power Grain Bowl',
                'description' => 'Quinoa, đậu lăng, rau củ nướng, hạt điều.',
                'price' => 135000,
                'calories' => 520,
                'protein' => 22,
                'carb' => 58,
                'fat' => 18,
                'fiber' => 10,
                'sugar' => 6,
                'is_active' => true,
                'is_featured' => true,
                'is_vegetarian' => true,
                'goal_tag' => 'giữ dáng',
                'sort_order' => 3,
            ]
        );

        $this->call([
            AdminUserSeeder::class,
            SampleDataSeeder::class,
        ]);
    }
}
