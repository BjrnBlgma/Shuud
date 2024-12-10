<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
    protected $table = 'post_files';
    protected $fillable = [
        'post_id',
        'file_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class , 'id', 'post_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
