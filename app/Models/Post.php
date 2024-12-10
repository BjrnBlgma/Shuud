<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\returnSelf;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'post_type_id'
    ];

    public function postFile()
    {
        return $this->hasMany( PostFile::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function postType()
    {
        return $this->belongsTo(PostType::class, 'post_type_id', 'id');
    }

    public static function booted()
    {
        static::deleting(function ($post) {
            // Удаляем связанные файлы из директории
            foreach ($post->postFile as $postFile) {
                $file = $postFile->file;

                if ($file) {
                    // Удаляем физический файл
                    if (Storage::disk('public')->exists($file->path)) {
                        Storage::disk('public')->delete($file->path);
                    }

                    // Удаляем запись из таблицы files
                    $file->delete();
                }
            }

            // Удаляем записи в таблице post_files (происходит автоматически, если настроено каскадное удаление)
        });
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
