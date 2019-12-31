<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['slug', 'target'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return sprintf('s/%s', $this->slug);
    }
}
