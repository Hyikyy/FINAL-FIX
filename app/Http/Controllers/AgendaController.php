<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // Import Carbon
use TCPDF;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource (Admin).
     */
    public function index()
    {
        $agendas = Agenda::all();
        return view('admin.agendas.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource (Admin).
     */
    public function create()
    {
        return view('admin.agendas.create');
    }

    /**
     * Store a newly created resource in storage (Admin).
     */
    public function store(Request $request)
{
    $request->validate([
        'nama_kegiatan' => 'required',
        'tanggal_kegiatan' => 'required|date',
        'deskripsi' => 'required',
    ]);

    $data = $request->all();
    $data['user_id'] = auth()->user()->id; // Menambahkan user_id berdasarkan user yang sedang login

    Agenda::create($data);

    return redirect()->route('admin.agendas.index')
         ->with('success', 'Agenda berhasil ditambahkan.');
}


    /**
     * Display the specified resource (Admin).
     */
    public function show(Agenda $agenda)
    {
        return view('admin.agendas.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource (Admin).
     */
    public function edit(Agenda $agenda)
    {
        return view('admin.agendas.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage (Admin).
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi' => 'required',
        ]);

        $data = $request->all();
        $agenda->update($data);

        return redirect()->route('admin.agendas.index')
            ->with('success', 'Agenda berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage (Admin).
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('admin.agendas.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }

    /**
     * Display the specified resource (Public).
     */
    public function showPublic(Agenda $agenda)
    {
        // Generate Kalender HTML
        $tanggalKegiatan = Carbon::parse($agenda->tanggal_kegiatan);
        $tahun = $tanggalKegiatan->year;
        $bulan = $tanggalKegiatan->month;
        $kalenderHTML = $this->generateCalendar($tahun, $bulan, $agenda);

        return view('agendas.show', compact('agenda', 'kalenderHTML'));
    }

    private function generateCalendar($year, $month, $agenda)
    {
        $tanggalKegiatan = Carbon::parse($agenda->tanggal_kegiatan);

        // Hari pertama pada bulan tersebut
        $firstDayOfMonth = Carbon::createFromDate($year, $month, 1);
        $dayOfWeek = $firstDayOfMonth->dayOfWeek; // 0 (Minggu) - 6 (Sabtu)

        // Jumlah hari dalam bulan tersebut
        $daysInMonth = $tanggalKegiatan->daysInMonth;

        // Nama bulan
        $namaBulan = $tanggalKegiatan->format('F');

        $html = '<table class="table table-bordered">';
        $html .= '<thead><tr><th colspan="7" style="text-align: center;">' . $namaBulan . ' ' . $year . '</th></tr>';
        $html .= '<tr><th>Minggu</th><th>Senin</th><th>Selasa</th><th>Rabu</th><th>Kamis</th><th>Jumat</th><th>Sabtu</th></tr></thead>';
        $html .= '<tbody>';

        $dayCounter = 1;
        for ($i = 0; $i < 6; $i++) { // Maksimal 6 baris untuk kalender
            $html .= '<tr>';
            for ($j = 0; $j < 7; $j++) {
                if ($i === 0 && $j < $dayOfWeek) {
                    // Sel sebelum hari pertama
                    $html .= '<td></td>';
                } elseif ($dayCounter <= $daysInMonth) {
                    $tanggal = Carbon::createFromDate($year, $month, $dayCounter);
                    $isKegiatan = $tanggal->isSameDay($tanggalKegiatan); // Cek apakah ini tanggal kegiatan

                    $style = $isKegiatan ? 'style="background-color: #FFFF00;"' : ''; // Warna kuning jika tanggal kegiatan
                    $html .= '<td ' . $style . '>' . $dayCounter . '</td>';
                    $dayCounter++;
                } else {
                    // Sel setelah hari terakhir
                    $html .= '<td></td>';
                }
            }
            $html .= '</tr>';

            if ($dayCounter > $daysInMonth) {
                break; // Keluar dari loop jika sudah mencapai akhir bulan
            }
        }

        $html .= '</tbody></table>';
        return $html;
    }

        /**
     * Display a listing of the public resource.
     */
    public function listPublic()
    {
        $agendas = Agenda::all();
        return view('agendas.index', compact('agendas'));
    }
}