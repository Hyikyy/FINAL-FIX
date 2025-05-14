<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApaKataAlumni extends Model
{
    use HasFactory;

    protected $table = 'apa_kata_alumni';
    protected $fillable = ['nama', 'angkatan', 'isi', 'gambar','pekerjaan', 'user_id']; // Tambahkan 'gambar'
}