<?php

namespace Tests\Feature;

use App\ShortenedUrl;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ShortenedUrlTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function should_redirect_to_url()
    {
        $shortenedUrl = factory(ShortenedUrl::class)->create();

        $this->get('s/' . $shortenedUrl->path)
            ->assertRedirect(($shortenedUrl->url));
    }

    /** @test */
    public function should_not_generate_duplicate_short_urls()
    {
        $this->markTestIncomplete();
    }
}
