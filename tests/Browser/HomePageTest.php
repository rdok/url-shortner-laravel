<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
    /** @test */
    public function create_short_link()
    {
        $this->browse(function (Browser $browser) {

            $url = 'https://www.youtube.com/watch?v=qIcTM8WXFjk';

            $browser->visit(new HomePage)
                ->assertDontSee('View')
                ->createShortLink($url)
                ->assertSeeIn('@shortened-link', 'View');
        });
    }

}
