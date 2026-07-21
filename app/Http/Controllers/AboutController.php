<?php

namespace App\Http\Controllers;

use App\Support\AboutGallery;

class AboutController extends Controller
{
    public function index()
    {
        $galleryImages = AboutGallery::aboutImages();

        return view('about', compact('galleryImages'));
    }
}
