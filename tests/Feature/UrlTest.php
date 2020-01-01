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
    public function create_shortened_url_for_guests()
    {
        $this->mock(Generator::class, function ($mock) {
            $mock->shouldReceive('regexify')->once()->andReturn('expected-slug');
        });

        $data = [
            'slug' => 'expected-slug',
            'target' => $this->url
        ];

        $this->assertDatabaseMissing('urls', $data);

        $response = $this->post('urls', [
            'url' => $this->url,
            '_token' => csrf_token()
        ])->assertRedirect('/');

        $url = Url::query()->where($data)->firstOrFail();
        $response->assertSessionHas('urlId', $url->id);
    }

    /** @test */
    public function create_shortened_url_for_loggedin_users()
    {
        $user = factory(User::class)->create();

        $this->mock(Generator::class, function ($mock) {
            $mock->shouldReceive('regexify')->once()->andReturn('expected-slug');
        });

        $data = [
            'slug' => 'expected-slug',
            'target' => $this->url,
            'author_id' => $user->id
        ];

        $this->assertDatabaseMissing('urls', $data);

        $response = $this
            ->actingAs($user)
            ->post('urls', ['url' => $this->url, '_token' => csrf_token()])
            ->assertRedirect('/');

        $url = Url::query()->where($data)->firstOrFail();
        $response->assertSessionHas('urlId', $url->id);
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
