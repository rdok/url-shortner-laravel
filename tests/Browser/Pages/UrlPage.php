<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class UrlPage extends Page
{
    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser
            ->assertPathIs($this->url())
            ->assertDontSee(404)
            ->assertDontSee('Not Found');
    }

    public function url()
    {
        return '/urls';
    }

    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
