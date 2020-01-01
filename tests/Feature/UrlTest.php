<?php

namespace Tests\Feature;

use App\User;
use Faker\Generator;
use Mockery\Mock;
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
    public function create_shortened_url_for_guests()
    {
        $this->mock(Generator::class, function ($mock) {
            $mock->shouldReceive('regexify')->once()->andReturn('expected-slug');
        });

        $this->assertDatabaseMissing('urls', ['target' => $this->url]);

        $this->post('urls', ['url' => $this->url])
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
        $user = factory(User::class)->create();
        $this->mock(Generator::class, function ($mock) {
            /** @var Mock $mock */
            $mock->shouldReceive('regexify')->once()->andReturn('expected-uslug');
        });

        $this->assertDatabaseMissing('urls', ['target' => $this->url]);

        $this
            ->actingAs($user)
            ->post('urls', ['url' => $this->url])
            ->assertExactJson(['slug' => 'expected-uslug', 'url' => $this->url])
            ->assertStatus(200);

        $this->assertDatabaseHas('urls', [
            'slug' => 'expected-uslug',
            'target' => $this->url,
            'author_id' => $user->id
        ]);
    }

    /** @test */
    public function should_validate_store_requests()
    {
        $this->post('urls')
            ->assertExactJson(['url' => ['The url field is required.']]);

        $this->post('urls', ['url' => 'invalid'])
            ->assertExactJson(['url' => ['The url format is invalid.']]);
    }
}
