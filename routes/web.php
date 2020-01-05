<?php

use App\Url;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('urls', 'UrlController')->only(['index', 'store']);


Route::get('react', function () {
    return view('react');
});

Route::get('/welcome2', function () {
    $data = [];

    if (session()->has('urlId')) {
        $url = Url::query()->findOrFail(session('urlId'));
        $data = compact('url');
    }

    return view('welcome2', $data);
});
