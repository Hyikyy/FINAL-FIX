<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasi'; // Jika nama tabel berbeda dari nama model (snake case)

    protected $fillable = [
        'nama_anggota',
        'nama_jabatan',
        'periode',
        'gambar',
        'deskripsi_jabatan',
        'user_id',
    ];
}