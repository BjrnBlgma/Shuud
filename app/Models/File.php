<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = ['post_id', 'image'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
