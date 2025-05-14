<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Agenda;
use App\Models\VisiMisi; // Tambahkan ini

use Carbon\Carbon;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $beritasTerbaru = Berita::orderBy('tanggal', 'desc')->take(6)->get(); // Ambil 6 berita terbaru
        $agendasTerdekat = Agenda::where('tanggal_kegiatan', '>=', now())
                                    ->orderBy('tanggal_kegiatan', 'asc')
                                    ->take(3)
                                    ->get();
        $agendasRutin = Agenda::whereMonth('tanggal_kegiatan', now()->month)
                                ->orderBy('tanggal_kegiatan', 'asc')
                                ->get();

        $visiMisi = VisiMisi::all();  // Ambil data Visi dan Misi

        return view('welcome', compact('beritasTerbaru', 'agendasTerdekat', 'agendasRutin', 'visiMisi'));

        $agendasRutin = Agenda::where('jenis', 'rutin') // Ganti 'jenis' dengan kolom yang sesuai
            ->where('tanggal_kegiatan', '>=', Carbon::now()->startOfMonth())
            ->where('tanggal_kegiatan', '<=', Carbon::now()->endOfMonth())
            ->orderBy('tanggal_kegiatan')
            ->limit(5) // Batasi jumlah agenda yang ditampilkan
            ->get();

        $agendasTerdekat = Agenda::where('tanggal_kegiatan', '>=', Carbon::now())
            ->orderBy('tanggal_kegiatan')
            ->limit(5) // Batasi jumlah agenda yang ditampilkan
            ->get();


        return view('welcome', compact('agendasRutin', 'agendasTerdekat'));
    }
}