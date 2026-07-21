<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()
            ->active()
            ->ordered()
            ->withCount(['products' => fn ($query) => $query->active()])
            ->get();

        $productsQuery = Product::query()
            ->with('category')
            ->active()
            ->ordered();

        $activeCategory = null;

        if ($request->filled('kategori')) {
            $activeCategory = Category::query()
                ->active()
                ->where('slug', $request->string('kategori'))
                ->first();

            if ($activeCategory) {
                $productsQuery->where('category_id', $activeCategory->id);
            }
        }

        $products = $productsQuery->get();

        return view('products', compact('products', 'categories', 'activeCategory'));
    }
}
