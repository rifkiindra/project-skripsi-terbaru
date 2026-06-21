<?php

namespace App\Models;

use App\Models\Message;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use App\Models\Artwork;
use App\Models\Member;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'from_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'from_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to_id');
    }
    
    public function lastMessageWithAdmin($adminId)
{
    return Message::where(function ($q) use ($adminId) {
            $q->where('from_id', $this->id)
              ->where('to_id', $adminId);
        })
        ->orWhere(function ($q) use ($adminId) {
            $q->where('from_id', $adminId)
              ->where('to_id', $this->id);
        })
        ->latest()
        ->first();
}
// USER → MEMBER
public function member()
{
    return $this->hasOne(Member::class, 'user_id');
}

    public function artworks(): HasManyThrough
{
    return $this->hasManyThrough(
        Artwork::class,
        Member::class,
        'user_id',
        'member_id',
        'id',
        'id'
    );
}

}
