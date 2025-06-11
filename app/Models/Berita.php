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
        'user_id',
        'category_id' // Tambahkan ini
    ];

    public function feedback()
    {
        return $this->hasMany(Feedback::class)->orderBy('tanggal', 'desc'); // Ambil feedback dan urutkan dari terbaru
    }

    // Tambahkan relasi ke model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Jika Anda ingin menampilkan nama user yang membuat berita
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan BeritaImage
    public function images()
    {
        return $this->hasMany(BeritaImage::class);
    }
}