<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $table = 'tournaments';
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'location',
        'created_user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }
}
