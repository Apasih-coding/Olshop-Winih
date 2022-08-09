<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'username',
        'email',
        'product',
        'subject',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
