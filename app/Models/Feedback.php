<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'berita_id',
        'user_id',
        'nama',
        'tanggal',
        'isi',
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class); // Relasi ke model User
    }
}