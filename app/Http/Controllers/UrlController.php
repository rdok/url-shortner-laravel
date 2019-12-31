<?php

namespace App\Http\Controllers;

use App\Url;
use Faker\Generator;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function show($slug)
    {
        $url = Url::query()->where('slug', $slug)->firstOrFail();

        return redirect($url->target);
    }

    public function store(Request $request, Generator $generator)
    {
        $shortenedUrl = new Url([
            'slug' => $generator->regexify('[A-Za-z0-9$\-_.+!*\'(),]{3,7}'),
            'target' => $request->get('url')
        ]);

        $shortenedUrl->save();

        return response()->json([
            'slug' => $shortenedUrl->slug,
            'url' => $shortenedUrl->target,
        ]);
    }
}
