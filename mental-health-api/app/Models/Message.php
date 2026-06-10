<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'room_id',
        'sender_id',
        'body',
        'is_read',
    ];

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class, 'room_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
