<?php

namespace App\Services;

use App\Url;
use Faker\Generator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UrlRepository
{
    /** @var Generator */
    private $generator;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function store(array $data)
    {
        $slug = $this->generateUniqueSlug();
        $url = new Url(['slug' => $slug, 'target' => $data['url']]);

        if (Auth::check()) {
            $url->author()->associate(Auth::user());
        }

        $url->save();

        return $url;
    }

    private function generateUniqueSlug()
    {
        $maxLength = 7;

        do {
            $regex = sprintf('[A-Za-z0-9$\-_.+!*\'(),]{3,%s}', $maxLength);
            $slug = $this->generator->regexify($regex);

            /** @var Builder $urlSlug */
            $urlSlug = Url::query()->where('slug', $slug);
            $maxLength++;
        } while ($urlSlug->exists());

        return $slug;
    }
}