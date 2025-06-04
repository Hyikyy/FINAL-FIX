<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi_gambar',
        'kategori_galeri_id',
        'user_id',
    ];

    protected $casts = [
        'tanggal_upload' => 'datetime', // Jika ada kolom tanggal upload
    ];


    public function kategoriGaleri()
    {
        return $this->belongsTo(KategoriGaleri::class, 'kategori_galeri_id');
    }

    /**
     * Relasi ke User (opsional).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
