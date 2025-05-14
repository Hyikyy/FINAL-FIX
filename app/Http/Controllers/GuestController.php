<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisi;
use App\Models\Agenda;
use App\Models\Berita;

class GuestController extends Controller
{
    public function index()
    {
        // Ambil semua data visi dan misi
        $visiMisi = VisiMisi::all(); // atau bisa tambahkan fallback collect() jika perlu

        // Ambil data agenda terdekat (contoh 5 data terdekat)
        $agendasTerdekat = Agenda::whereDate('tanggal_kegiatan', '>=', now())
            ->orderBy('tanggal_kegiatan', 'asc')
            ->take(5)
            ->get();

        // Ambil agenda rutin bulan ini
        $agendasRutin = Agenda::whereMonth('tanggal_kegiatan', now()->month)->get();

        // Ambil berita terbaru
        $beritasTerbaru = Berita::latest()->take(3)->get();

        // Kirim semua data ke view
        return view('welcome', compact('visiMisi', 'agendasTerdekat', 'agendasRutin', 'beritasTerbaru'));
    }
}
