<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Services\UrlRepository;
use App\Url;

class UrlController extends Controller
{
    public function show($slug)
    {
        $url = Url::query()->where('slug', $slug)->firstOrFail();

        return redirect($url->target);
    }

    public function store(StoreUrlRequest $request, UrlRepository $repository)
    {
        $url = $repository->store($request->only('url'));

        return response()->json([
            'slug' => $url->slug,
            'url' => $url->target,
        ]);
    }
}
