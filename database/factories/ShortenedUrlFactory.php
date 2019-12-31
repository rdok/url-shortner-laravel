<?php

/** @var Factory $factory */

use App\ShortenedUrl;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ShortenedUrl::class, function (Faker $faker) {

    /** @var ShortenedUrl $shortenedUrl */
    $shortenedUrl = factory(ShortenedUrl::class, 'fillable')->make();

    return array_merge($shortenedUrl->toArray(), [
        'author_id' => function () {
            return factory(User::class)->create();
        },
    ]);
});

$factory->defineAs(ShortenedUrl::class, 'fillable', function (Faker $faker) {

    return [
        'url' => $faker->url,
        'path' => $faker->regexify('[A-Za-z0-9$-_.+!*\'(),]{3,7}')
    ];
});
