<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id', 'user_nama', 'user_jk', 'user_email', 'password', 'user_alamat', 'user_phone', 'user_modifikasi', 'role', 'fcm_token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pengaduan(){
        return $this->hasMany(Pengaduan::class);
    }
}
