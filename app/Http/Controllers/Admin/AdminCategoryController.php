<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->withCount('products')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.form', ['category' => new Category()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Đã tạo danh mục.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $this->validateData($request, $category->id);
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Đã cập nhật danh mục.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Đã xoá danh mục.');
    }

    protected function validateData(Request $request, ?int $categoryId = null): array
    {
        $request->merge([
            'is_active' => $request->boolean('is_active'),
        ]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $baseSlug = trim((string) ($data['slug'] ?? ''));
        if ($baseSlug === '') {
            $baseSlug = Str::slug((string) $data['name']);
        }
        if ($baseSlug === '') {
            $baseSlug = 'danh-muc';
        }

        $slug = $baseSlug;
        $i = 2;
        while (Category::query()
            ->when($categoryId, fn ($q) => $q->whereKeyNot($categoryId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $baseSlug.'-'.$i;
            $i++;
        }

        $data['slug'] = $slug;

        return $data;
    }
}

