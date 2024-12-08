<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $table = 'post_types';
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'post_type_id', 'id');
    }
}
