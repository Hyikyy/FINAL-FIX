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
        'name',
        'nim',
        'username',
        'password',
        'role', // Tambahkan 'role' di sini
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        // Sesuaikan logika ini dengan implementasi role di aplikasi Anda
        return $this->role === 'admin'; // Contoh jika role disimpan sebagai string 'admin'
        // atau jika Anda menggunakan enum atau integer:
        // return $this->role === 1; // Contoh jika role adalah integer (misalnya 1 untuk admin)
    }
}