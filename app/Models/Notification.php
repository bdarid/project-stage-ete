<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'users_id',
        'titre',
        'message',
        'type',
        'lu',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'users_id');
    }
}