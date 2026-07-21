<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\AboutGallery;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with('category')
            ->active()
            ->featured()
            ->ordered()
            ->get();

        $galleryImages = AboutGallery::homeImages();

        return view('home', compact('products', 'galleryImages'));
    }
}
