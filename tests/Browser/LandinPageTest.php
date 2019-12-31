<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LandinPageTest extends DuskTestCase
{
    /** @test */
    public function welcome_message()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('URL Shortner');
        });
    }
}
