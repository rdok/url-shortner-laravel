<?php

namespace Tests\Unit;

use App\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    /** @var Url */
    private $url;

    public function setUp(): void
    {
        parent::setUp();

        $this->url = new Url;
        $this->url->slug = 'cyberpunk-2077';
    }

    /** @test */
    public function should_have_path()
    {
        $this->assertSame('s/cyberpunk-2077', $this->url->path());
    }
}
