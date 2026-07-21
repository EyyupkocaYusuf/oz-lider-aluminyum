<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with('category')
            ->ordered()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::query()->active()->ordered()->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.create')
            ->with('success', 'Ürün başarıyla eklendi.');
    }

    public function edit(Product $product)
    {
        $categories = Category::query()->active()->ordered()->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request, $product);

        if ($request->hasFile('image')) {
            $this->deleteUploadedImage($product->image_path);
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Ürün başarıyla güncellendi.');
    }

    public function destroy(Product $product)
    {
        $this->deleteUploadedImage($product->image_path);
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Ürün silindi.');
    }

    private function validateProduct(Request $request, ?Product $product = null): array
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = $this->generateSlug($validated['title'], $product?->id);
        $validated['description'] = $product?->description ?? '';
        $validated['price'] = $product?->price ?? 0;
        $validated['sort_order'] = $product?->sort_order ?? 0;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        unset($validated['image']);

        return $validated;
    }

    private function deleteUploadedImage(?string $path): void
    {
        if (! $path || str_starts_with($path, 'images/')) {
            return;
        }

        Storage::disk('public')->delete($path);
    }

    private function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (Product::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $original.'-'.$count;
            $count++;
        }

        return $slug;
    }
}
