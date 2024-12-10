<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = ['path'];

    public function postFiles()
    {
        return $this->hasMany( PostFile::class, 'file_id', 'id');
    }
}
