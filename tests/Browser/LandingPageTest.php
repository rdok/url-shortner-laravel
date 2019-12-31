<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LandingPageTest extends DuskTestCase
{
    /** @test */
    public function welcome_message()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('url', 'https://www.youtube.com/watch?v=qIcTM8WXFjk')
                ->press('Shorten')
                ->assertPathIs('/')
                ->assertSee('small-url');
        });
    }
}
