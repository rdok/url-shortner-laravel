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

    function path()
    {
        return sprintf('s/%s', $this->slug);
    }

    function author()
    {
        return $this->belongsTo(User::class);
    }
}
