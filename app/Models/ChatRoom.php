<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = [
        'user_id',
        'therapist_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapist_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'room_id');
    }
}
