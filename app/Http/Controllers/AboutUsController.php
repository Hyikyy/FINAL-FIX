<?php

namespace App\Http\Controllers;
use App\Models\Alumni;
use App\Models\Dosen;
use App\Models\TeachingAssistant;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function showPublic()
    {
        $alumnis = Alumni::orderBy('angkatan', 'desc')->orderBy('nama', 'asc')->paginate(4);
        $angkatans = Alumni::select('angkatan')
                            ->whereNotNull('angkatan')
                            ->distinct()
                            ->orderBy('angkatan', 'desc')
                            ->pluck('angkatan'); // pluck hanya mengambil kolom 'angkatan'

        $teachingAssistants = TeachingAssistant::all();
        $dosens = Dosen::all();
        return view('about_us.index', compact('dosens', 'teachingAssistants', 'alumnis','angkatans'));
    }

    public function showDetail($id)
    {
        $currentRouteName = Route::currentRouteName();

        if (strpos($currentRouteName, 'dosen') !== false) {
            $data = Dosen::findOrFail($id);
            $type = 'Dosen';
        } elseif (strpos($currentRouteName, 'asisten') !== false) {
            $data = TeachingAssistant::findOrFail($id);
            $type = 'Asisten Dosen';
        } else {
            $data = Alumni::findOrFail($id);
            $type = 'Alumni';
        }

        return view('dosens.show', compact('data', 'type'));
    }
}
