<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortenedUrl extends Model
{
    public function getRouteKeyName()
    {
        return 'path';
    }
}
