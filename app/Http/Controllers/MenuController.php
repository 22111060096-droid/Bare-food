<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $query = Product::query()
            ->with('category')
            ->where('is_active', true);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->string('category'));
            });
        }

        if ($request->filled('goal')) {
            $query->where('goal_tag', $request->string('goal'));
        }

        if ($request->filled('calories')) {
            $range = $request->string('calories');
            if ($range === 'under-400') {
                $query->where('calories', '<', 400);
            } elseif ($range === '400-600') {
                $query->whereBetween('calories', [400, 600]);
            } elseif ($range === 'above-600') {
                $query->where('calories', '>', 600);
            }
        }

        if ($request->boolean('high_protein')) {
            $query->where('protein', '>=', 20);
        }

        if ($request->boolean('vegetarian')) {
            $query->where('is_vegetarian', true);
        }

        $products = $query->orderBy('sort_order')->orderBy('name')->paginate(12)->withQueryString();

        return view('menu.index', [
            'categories' => $categories,
            'products' => $products,
            'filters' => $request->only(['category', 'goal', 'calories', 'high_protein', 'vegetarian']),
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::query()
            ->with('category', 'toppings')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $related = Product::query()
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        return view('menu.show', [
            'product' => $product,
            'related' => $related,
        ]);
    }
}

