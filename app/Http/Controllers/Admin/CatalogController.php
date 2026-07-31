<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::query()
            ->ordered()
            ->get();

        return view('admin.catalogs.index', compact('catalogs'));
    }

    public function create()
    {
        return view('admin.catalogs.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateCatalog($request);

        Catalog::create($validated);

        return redirect()
            ->route('admin.catalogs.create')
            ->with('success', 'Katalog başarıyla eklendi.');
    }

    public function edit(Catalog $catalog)
    {
        return view('admin.catalogs.edit', compact('catalog'));
    }

    public function update(Request $request, Catalog $catalog)
    {
        $validated = $this->validateCatalog($request, $catalog);

        if ($catalog->pdf_path) {
            Storage::disk('public')->delete($catalog->pdf_path);
            $validated['pdf_path'] = null;
        }

        $catalog->update($validated);

        return redirect()
            ->route('admin.catalogs.edit', $catalog)
            ->with('success', 'Katalog başarıyla güncellendi.');
    }

    public function destroy(Catalog $catalog)
    {
        if ($catalog->pdf_path) {
            Storage::disk('public')->delete($catalog->pdf_path);
        }

        $catalog->delete();

        return redirect()
            ->route('admin.catalogs.index')
            ->with('success', 'Katalog silindi.');
    }

    private function validateCatalog(Request $request, ?Catalog $catalog = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('catalogs', 'code')->ignore($catalog?->id),
            ],
            'pdf_link' => ['required', 'url', 'max:2048'],
        ], [
            'pdf_link.required' => 'Katalog bağlantısı zorunludur.',
            'pdf_link.url' => 'Geçerli bir bağlantı girin. Örn. https://ornek.com/katalog.pdf',
        ]);

        $validated['category_id'] = $catalog?->category_id;
        $validated['description'] = $catalog?->description ?? '';
        $validated['sort_order'] = $catalog?->sort_order ?? 0;
        $validated['is_active'] = $catalog?->is_active ?? true;

        return $validated;
    }
}
