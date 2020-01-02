<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\Browser\Components\NavigationHeader;
use Tests\Browser\Pages\HomePage;
use Tests\Browser\Pages\UrlPage;
use Tests\DuskTestCase;

class UrlPageTest extends DuskTestCase
{
    /** @test */
    public function show_anonymous_urls()
    {
        $this->browse(function (Browser $browser) {
            $shortenedUrl = $browser->visit(new HomePage)
                ->createShortLink('https://www.cyberpunk.net/gb/en/')
                ->text('@shortened-link-badge');

            $browser->within(new NavigationHeader, function ($browser) {
                /** @var NavigationHeader $browser */
                $browser->visitAnonymousPage();
            })->assertPathIs((new UrlPage)->url());

            $browser->assertSeeLink($shortenedUrl);
        });
    }
}
