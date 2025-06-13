<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Agenda;
use App\Models\VisiMisi; // Tambahkan ini

use Carbon\Carbon;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $beritasTerbaru = Berita::orderBy('tanggal', 'desc')->take(6)->get();
        $agendasTerdekat = Agenda::where('tanggal_kegiatan', '>=', now())
                                    ->orderBy('tanggal_kegiatan', 'asc')
                                    ->take(5)
                                    ->get();



    $currentYear = $request->input('year', Carbon::now()->year);
    $currentMonth = $request->input('month', Carbon::now()->month);

    $agendasRutin = Agenda::whereMonth('tanggal_kegiatan', $currentMonth)
                                ->whereYear('tanggal_kegiatan', $currentYear)
                                // ->where('jenis', 'rutin') // Sesuaikan jika ada kolom jenis
                                ->orderBy('tanggal_kegiatan', 'asc')
                                ->take(5)
                                ->get();

    $visiMisi = VisiMisi::all();
    // PENTING: Ambil SEMUA agenda untuk bulan dan tahun yang ditampilkan kalender
    // Kemudian di-keyBy hari agar mudah diakses di view
    $agendasForCalendar = Agenda::whereYear('tanggal_kegiatan', $currentYear)
                                ->whereMonth('tanggal_kegiatan', $currentMonth)
                                ->orderBy('tanggal_kegiatan', 'asc') // Urutkan, meskipun keyBy akan ambil salah satu
                                ->get()
                                ->keyBy(function ($item) {
                                    return Carbon::parse($item->tanggal_kegiatan)->day;
                                });

    return view('welcome', compact(
        'beritasTerbaru',
        'agendasTerdekat',
        'agendasRutin',
        'visiMisi',
        'request',
        'agendasForCalendar', 
        'currentYear',
        'currentMonth'
    ));
    }
}