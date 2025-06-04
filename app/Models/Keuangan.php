<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = 'keuangan';
    protected $fillable = [
    'tanggal', // <--- PASTIKAN INI ADA
    'deskripsi',
    'jumlah',
    'jenis',
    'user_id',
    ];

    protected $casts = [
        'tanggal' => 'date', // Otomatis cast ke instance Carbon
        'jumlah' => 'decimal:2',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePemasukan($query)
    {
        return $query->where('jenis', 'pemasukan');
    }

    public function scopePengeluaran($query)
    {
        return $query->where('jenis', 'pengeluaran');
    }

}
