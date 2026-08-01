<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ServicePageController extends Controller
{
    public function show(string $service): View
    {
        $page = config('seo-services.'.$service);

        if (! $page) {
            throw new NotFoundHttpException;
        }

        $related = collect($page['related'] ?? [])
            ->mapWithKeys(fn (string $slug) => [$slug => config('seo-services.'.$slug)])
            ->filter()
            ->all();

        return view('service', [
            'slug' => $service,
            'page' => $page,
            'related' => $related,
        ]);
    }
}
