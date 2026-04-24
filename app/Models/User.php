<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_user';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'nomor_induk',
        'role',
        'verification_token',
        'email_verified_at',
        'reset_token',
        'reset_token_expired_at',
    ];

    protected $hidden = [
        'password'
    ];

    public function anakPkl()
    {
        return $this->hasMany(AnakPkl::class);
    }

    public function profile()
    {
    return $this->hasOne(Profil::class);
    }
}