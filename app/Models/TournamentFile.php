<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TournamentFile extends Model
{
    protected $table = 'tournament_files';

    protected $fillable = [
        'tournament_id',
        'file_id',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'id', 'tournament_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
