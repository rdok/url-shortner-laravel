<?php

namespace Tests\Feature;

use App\Url;
use Tests\TestCase;

class RedirectUrlTest extends TestCase
{
    /** @test */
    public function redirect_to_url()
    {
        /** @var Url $url */
        $url = factory(Url::class)->create();

        $this->get($url->path())
            ->assertRedirect($url->target);
    }
}