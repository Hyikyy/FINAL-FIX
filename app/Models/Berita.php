<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'gambar',
        'user_id'
    ];

    public function feedback()
    {
        return $this->hasMany(Feedback::class)->orderBy('tanggal', 'desc'); // Ambil feedback dan urutkan dari terbaru
    }


}
