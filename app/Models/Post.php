<?php

namespace App\Models;

use Faker\Provider\Image;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\returnSelf;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'post_type_id'
    ];

    public function images()
    {
        return $this->hasMany( \App\Models\Image::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function postType()
    {
        return $this->belongsTo(PostType::class, 'post_type_id', 'id');
    }

    public function getShortContent($sentenceCount = 3)
    {
        $sentences = preg_split('/([.!?:])\s/', $this->content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $shortContent = '';

        for ($i = 0; $i < $sentenceCount * 2 && $i < count($sentences); $i += 2) {
            $shortContent .= $sentences[$i] . ($sentences[$i + 1] ?? '') . ' ';
        }

        return trim($shortContent) . (count($sentences) > $sentenceCount * 2 ? '...' : '');
    }
}
