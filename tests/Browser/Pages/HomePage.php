<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class HomePage extends Page
{
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function url()
    {
        return '/';
    }

    public function elements()
    {
        return [
            '@url' => 'input[name=url]',
            '@shortened-link' => 'a[dusk=shortened-url-link]',
        ];
    }

    public function createShortLink(Browser $browser, $url)
    {
        $browser
            ->type('@url', $url)
            ->press('Shorten')
            ->assertPathIs($this->url());
    }
}
