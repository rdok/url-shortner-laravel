<?php

namespace App\Http\Controllers;

use App\ShortenedUrl;

class ShortenedUrlController extends Controller
{
    public function create(ShortenedUrl $shortenedUrl)
    {
        return redirect($shortenedUrl->url);
    }
}
