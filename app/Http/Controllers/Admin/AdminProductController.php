<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with('category')
            ->orderBy('category_id')
            ->orderBy('sort_order')
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.products.form', [
            'product' => new Product(),
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_url'] = 'storage/' . $path;
        }
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Đã tạo món mới.');
    }

    public function edit(Product $product)
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateData($request, $product->id);

        if ($request->hasFile('image')) {
            if ($product->image_url && str_starts_with($product->image_url, 'storage/')) {
                $old = substr($product->image_url, strlen('storage/'));
                Storage::disk('public')->delete($old);
            }

            $path = $request->file('image')->store('products', 'public');
            $data['image_url'] = 'storage/' . $path;
        }
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Đã cập nhật món.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Đã xoá món.');
    }

    protected function validateData(Request $request, ?int $productId = null): array
    {
        return $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'calories' => ['nullable', 'integer', 'min:0'],
            'protein' => ['nullable', 'integer', 'min:0'],
            'carb' => ['nullable', 'integer', 'min:0'],
            'fat' => ['nullable', 'integer', 'min:0'],
            'fiber' => ['nullable', 'integer', 'min:0'],
            'sugar' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],
            'is_vegetarian' => ['required', 'boolean'],
            'goal_tag' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'file', 'image', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}

