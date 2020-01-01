<?php

namespace Tests\Integration\Services;

use App\Services\UrlRepository;
use Faker\Generator;
use Mockery\Mock;
use Tests\TestCase;

class UrlRepositoryTest extends TestCase
{
    /** @test */
    public function should_handle_duplicate_slugs()
    {
        $this->mock(Generator::class, function ($mock) {
            /** @var Mock $mock */
            $mock->shouldReceive('regexify')->twice()->andReturn('duplicate-slug');
            $mock->shouldReceive('regexify')->once()->andReturn('unique-slug');
        });

        /** @var UrlRepository $urlRepository */
        $urlRepository = app()->make(UrlRepository::class);

        $url = $urlRepository->store(['url' => 'some-url']);
        $url2 = $urlRepository->store(['url' => 'some-url']);

        $this->assertNotSame($url->slug, $url2->slug);
    }
}