<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::query()
            ->with('category')
            ->active()
            ->ordered()
            ->get();

        return view('catalog', compact('catalogs'));
    }

    public function download(Catalog $catalog): Response
    {
        abort_unless($catalog->is_active && $catalog->hasPdf(), 404);

        if ($catalog->pdf_link) {
            return redirect()->away($catalog->pdf_link);
        }

        return Storage::disk('public')->download(
            $catalog->pdf_path,
            Str::slug($catalog->title).'.pdf'
        );
    }
}
