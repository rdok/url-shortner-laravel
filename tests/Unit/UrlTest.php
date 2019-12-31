<?php

namespace Tests\Unit;

use App\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    /** @test */
    public function should_have_path()
    {
        $url = new Url;
        $url->slug = 'cyberpunk-2077';

        $this->assertSame('s/cyberpunk-2077', $url->path());
    }
}
