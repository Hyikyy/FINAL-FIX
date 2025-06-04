<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGaleri extends Model
{
    use HasFactory;
    protected $table = 'kategori_galeris'; // Eksplisit jika nama tabel berbeda dari konvensi

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'slug_manually_set',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($kategori) {
            if (empty($kategori->slug)) {
                $kategori->slug = Str::slug($kategori->nama_kategori);
            }
        });
        static::updating(function ($kategori) {
            if ($kategori->isDirty('nama_kategori') && empty($kategori->slug)) {
                 $kategori->slug = Str::slug($kategori->nama_kategori);
            } elseif ($kategori->isDirty('nama_kategori') && $kategori->slug_manually_set !== true) {
                // Jika nama_kategori diubah dan slug tidak diisi manual, update slug
                $kategori->slug = Str::slug($kategori->nama_kategori);
            }
        });
    }

    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'kategori_galeri_id');
    }

    // Untuk URL yang menggunakan slug bukan ID
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
