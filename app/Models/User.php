<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; // <-- Wajib dipanggil

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements JWTSubject // <-- Tambahkan implements
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Fungsi wajib JWT untuk mengambil ID Pengguna
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Fungsi wajib JWT jika ingin menambahkan klaim khusus
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Relasi UAS: Satu User dapat memiliki banyak catatan Mood
    public function moods()
    {
        return $this->hasMany(Mood::class);
    }

    // Relasi UAS: Satu User dapat memiliki banyak hasil Tes Stres
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}