<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class NavigationHeader extends BaseComponent
{
    public function assert(Browser $browser)
    {
        $browser->assertVisible($this->selector());
    }

    public function selector()
    {
        return '#navbarSupportedContent';
    }

    public function elements()
    {
        return [
            '@anonymous-urls-page' => 'a[dusk=anonymous-urls-page]',
        ];
    }

    public function visitAnonymousPage($browser)
    {
        $browser->click('@anonymous-urls-page');
    }
}
