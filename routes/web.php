<?php

use App\Url;

Route::get('/', function () {
    $data = [];

    if (session()->has('urlId')) {
        $url = Url::query()->findOrFail(session('urlId'));
        $data = compact('url');
    }

    return view('welcome', $data);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('urls', 'UrlController')->only(['store']);
