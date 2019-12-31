<?php

namespace Tests\Integration;

use App\Url;
use Tests\TestCase;

class UrlTest extends TestCase
{
    /** @test */
    public function should_have_fillables()
    {
        $fillables = [
            'target' => 'https://www.youtube.com/channel/UC4zyoIAzmdsgpDZQfO1-lSA',
            'slug' => 'some-slug'
        ];

        $this->assertDatabaseMissing('urls', $fillables);

        (new Url($fillables))->save();

        $this->assertDatabaseHas('urls', $fillables);
    }
}