<?php

namespace App\Models;

use Faker\Provider\Image;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\returnSelf;

class Post extends Model
{
    protected $table = 'posts';

    public function images()
    {
        return $this->belongsTo(\App\Models\Image::class, 'post_id', 'id');
    }
}
