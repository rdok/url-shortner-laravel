<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Url;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    public function show($slug)
    {
        $url = Url::query()->where('slug', $slug)->firstOrFail();

        return redirect($url->target);
    }

    public function store(StoreUrlRequest $request, Generator $generator)
    {
        $url = new Url([
            'slug' => $generator->regexify('[A-Za-z0-9$\-_.+!*\'(),]{3,7}'),
            'target' => $request->get('url')
        ]);

        $user = Auth::user();

        $user ? $url->author()->associate($user)->save()
            : $url->save();

        return response()->json([
            'slug' => $url->slug,
            'url' => $url->target,
        ]);
    }
}
