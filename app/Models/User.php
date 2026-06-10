<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'address',
        'avatar',
        'bio',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ─── JWT Required ───────────────────────────────────────────────────────────

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // ─── Accessors ───────────────────────────────────────────────────────────────

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return Storage::url($this->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=396696&color=fff&size=128';
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────────

    public function scopeTherapists($query)
    {
        return $query->where('role', 'therapist')->where('status', 'active');
    }

    // ─── Relations ───────────────────────────────────────────────────────────────

    public function moods()
    {
        return $this->hasMany(Mood::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function news()
    {
        return $this->hasMany(News::class, 'author_id');
    }

    public function chatRoomsAsUser()
    {
        return $this->hasMany(ChatRoom::class, 'user_id');
    }

    public function chatRoomsAsTherapist()
    {
        return $this->hasMany(ChatRoom::class, 'therapist_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Alias so code can call $user->messages()
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // ─── Role Helpers ─────────────────────────────────────────────────────────────

    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isTherapist(): bool { return $this->role === 'therapist'; }
    public function isUser(): bool { return $this->role === 'user'; }
}