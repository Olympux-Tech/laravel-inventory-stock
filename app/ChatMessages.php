<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
    protected $fillable = [
        'admin_id', 'sender_id', 'sender_type', 'tunnel_id', 'username', 'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
