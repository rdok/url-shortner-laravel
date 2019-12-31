<?php

/** @var Factory $factory */

use App\Url;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Url::class, function (Faker $faker) {

    /** @var Url $shortenedUrl */
    $shortenedUrl = factory(Url::class, 'fillable')->make();

    return array_merge($shortenedUrl->toArray(), [
        'author_id' => function () {
            return factory(User::class)->create();
        },
    ]);
});

$factory->defineAs(Url::class, 'fillable', function (Faker $faker) {

    return [
        'target' => $faker->url,
        'slug' => $faker->regexify('[A-Za-z0-9-_.+!*(),]{3,7}')
    ];
});
