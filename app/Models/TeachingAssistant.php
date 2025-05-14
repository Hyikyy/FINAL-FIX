<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingAssistant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nama_jabatan',
        'gambar',
        'deskripsi_jabatan',
        'user_id',
    ];
}