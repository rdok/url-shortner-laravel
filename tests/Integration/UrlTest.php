<?php

namespace Tests\Integration;

use App\Url;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class UrlTest extends TestCase
{
    /** @var array */
    private $fillables;

    public function setUp(): void
    {
        parent::setUp();

        $this->fillables = [
            'target' => 'https://www.youtube.com/channel/UC4zyoIAzmdsgpDZQfO1-lSA',
            'slug' => 'some-slug'
        ];
    }

    /** @test */
    public function should_have_fillables()
    {
        $this->assertDatabaseMissing('urls', $this->fillables);

        (new Url($this->fillables))->save();

        $this->assertDatabaseHas('urls', $this->fillables);
    }

    /** @test */
    public function may_have_author()
    {
        $user = factory(User::class)->create();
        /** @var Url $url */
        $url = factory(Url::class, 'fillable')->create();

        $this->assertDatabaseMissing('urls', ['author_id' => $user->id]);

        $this->assertInstanceOf(BelongsTo::class, $url->author());
        $url->author()->associate($user)->save();

        $this->assertDatabaseHas('urls', [
            'id' => $url->id,
            'author_id' => $user->id,
        ]);
    }
}