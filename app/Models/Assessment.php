<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'total_score', 'level', 'category_scores'])]
class Assessment extends Model
{
    protected $casts = [
        'category_scores' => 'array',
    ];

    // Relasi balik: hasil tes ini milik seorang User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
