<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['post_id', 'image'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
