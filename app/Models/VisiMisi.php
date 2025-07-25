<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;

    protected $table = 'visi_misi'; // Sesuaikan dengan nama tabel
    protected $fillable = ['visi', 'misi', 'user_id'];
}