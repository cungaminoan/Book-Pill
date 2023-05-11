<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role',
        'gender',
        'status'
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class, 'id_user', 'id');
    }

    public function statusUser() {
        return $this->belongsTo(Status::class, 'status', 'id');
    }

    public function genderUser()
    {
        return $this->belongsTo(Gender::class, 'gender', 'id');
    }

    public function commentUser()
    {
        return $this->hasMany(Comment::class, 'id_user', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'id_user', 'id');
    }
}
