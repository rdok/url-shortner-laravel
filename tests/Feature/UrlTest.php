<?php

namespace Tests\Feature;

use App\Url;
use App\User;
use Faker\Generator;
use Tests\TestCase;

class UrlTest extends TestCase
{
    /** @var string */
    private $url;

    public function setUp(): void
    {
        parent::setUp();

        $this->url = 'https://www.youtube.com/watch?v=qIcTM8WXFjk&t=6s';
    }

    /** @test */
    public function redirect_to_url()
    {
        /** @var Url $url */
        $url = factory(Url::class)->create();

        $this->get($url->path())
            ->assertRedirect($url->target);
    }

    /** @test */
    public function create_shortened_url_for_guests()
    {
        $this->mock(Generator::class, function ($mock) {
            $mock->shouldReceive('regexify')->once()->andReturn('expected-slug');
        });

        $this->assertDatabaseMissing('urls', ['target' => $this->url]);

        $this->post('s/', ['url' => $this->url])
            ->assertExactJson(['slug' => 'expected-slug', 'url' => $this->url])
            ->assertStatus(200);

        $this->assertDatabaseHas('urls', [
            'slug' => 'expected-slug',
            'target' => $this->url
        ]);
    }

    /** @test */
    public function create_shortened_url_for_loggedin_users()
    {
        $this->markTestIncomplete();
        $this->assertDatabaseMissing('urls', ['target' => $this->url]);

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post('s/', ['url' => $this->url])
            ->assertExactJson(['slug' => 'some-slug', 'target' => $this->url])
            ->assertStatus(200);

        $this->assertDatabaseHas('urls', [
            'slug' => 'some-slug',
            'target' => $this->url,
            'author_id' => $user->id
        ]);
    }

    /** @test */
    public function should_not_generate_duplicate_short_urls()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function should_validate_creations()
    {
        $this->markTestIncomplete();
    }
}
