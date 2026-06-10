<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'score', 'notes'])]
class Mood extends Model
{
    // Relasi balik: Catatan mood ini milik seorang User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}