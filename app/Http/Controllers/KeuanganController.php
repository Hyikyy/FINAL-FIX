<?php

// Pastikan namespace sesuai dengan lokasi file controller Anda
// Jika di app/Http/Controllers/ maka namespace App\Http\Controllers;
// Jika di app/Http/Controllers/Admin/ maka namespace App\Http\Controllers\Admin;
namespace App\Http\Controllers; // ATAU App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Ini harusnya ada
use App\Models\Keuangan;
use App\Models\User; // Jika Anda ingin menampilkan nama user
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // Untuk DB::raw jika masih diperlukan

class KeuanganController extends Controller
{
    /**
     * Display a listing of the Keuangan resource for Admin.
     */
    public function index(Request $request) // Ini akan menjadi admin.keuangan.index
    {
        $query = Keuangan::with('user')->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc');

        if ($request->filled('filter_bulan') && $request->filter_bulan != '') {
            $query->whereMonth('tanggal', $request->filter_bulan);
        }
        if ($request->filled('filter_tahun') && $request->filter_tahun != '') {
            $query->whereYear('tanggal', $request->filter_tahun);
        }
        if ($request->filled('filter_jenis') && $request->filter_jenis != '') {
            $query->where('jenis', $request->filter_jenis);
        }

        // Clone query untuk kalkulasi tanpa pagination
        $queryForTotals = clone $query;
        $transaksisFiltered = $queryForTotals->get();

        $totalPemasukanFiltered = $transaksisFiltered->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaranFiltered = $transaksisFiltered->where('jenis', 'pengeluaran')->sum('jumlah');

        // Saldo Kas Keseluruhan (dari semua data, tidak terpengaruh filter)
        $pemasukanTotal = Keuangan::where('jenis', 'pemasukan')->sum('jumlah');
        $pengeluaranTotal = Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoKasKeseluruhan = $pemasukanTotal - $pengeluaranTotal;

        $transaksis = $query->paginate(15)->appends($request->query());

        // Data untuk filter dropdown
        $monthsForFilter = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthsForFilter[$m] = Carbon::create()->month($m)->locale('id')->monthName;
        }
        $yearsForFilter = Keuangan::selectRaw('YEAR(tanggal) as tahun')
                                ->distinct()
                                ->orderBy('tahun', 'desc')
                                ->pluck('tahun');

        return view('admin.keuangan.index', compact(
            'transaksis',
            'monthsForFilter',
            'yearsForFilter',
            'totalPemasukanFiltered',
            'totalPengeluaranFiltered',
            'saldoKasKeseluruhan'
        ));
    }

    /**
     * Show the form for creating a new Keuangan resource for Admin.
     */
    public function create()
    {
        return view('admin.keuangan.create');
    }

    /**
     * Store a newly created Keuangan resource in storage for Admin.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0.01', // Minimal ada nilainya
            'jenis' => 'required|in:pemasukan,pengeluaran',
        ]);

        Keuangan::create([
    'tanggal' => $validated['tanggal'], // atau $request->tanggal jika tidak pakai $validated array
    'deskripsi' => $validated['deskripsi'],
    'jumlah' => $validated['jumlah'],
    'jenis' => $validated['jenis'],
    'user_id' => auth()->id(),
]);

        return redirect()->route('admin.keuangan.index')->with('success', 'Transaksi keuangan berhasil ditambahkan.');
    }

    /**
     * Display the specified Keuangan resource for Admin.
     */
    public function show(Keuangan $keuangan) // Route model binding
    {
        $keuangan->load('user'); // Eager load user
        return view('admin.keuangan.show', compact('keuangan'));
    }

    /**
     * Show the form for editing the specified Keuangan resource for Admin.
     */
    public function edit(Keuangan $keuangan) // Route model binding
    {
        return view('admin.keuangan.edit', compact('keuangan'));
    }

    /**
     * Update the specified Keuangan resource in storage for Admin.
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0.01',
            'jenis' => 'required|in:pemasukan,pengeluaran',
        ]);

        $keuangan->update($validated);

        return redirect()->route('admin.keuangan.index')->with('success', 'Transaksi keuangan berhasil diperbarui.');
    }

    /**
     * Remove the specified Keuangan resource from storage for Admin.
     */
    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();
        return redirect()->route('admin.keuangan.index')->with('success', 'Transaksi keuangan berhasil dihapus.');
    }

    /**
     * Display a listing of the Keuangan resource for Public.
     * Ini method yang Anda sebut indexPublic sebelumnya, saya sesuaikan namanya agar lebih standar.
     * Anda bisa memindahkannya ke controller terpisah (misal PublikKeuanganController)
     * atau tetap di sini jika logicnya sederhana.
     */
    public function indexPublic(Request $request) // METHOD INI UNTUK VIEW USER/PUBLIK
    {

        // 1. Mengambil parameter filter dari URL (jika ada)
        $selectedMonth = $request->input('bulan', Carbon::now()->month);
        $selectedYear = $request->input('tahun', Carbon::now()->year);
        $filterPeriode = $request->input('periode', 'bulanan'); // Default 'bulanan'

        // 2. Membuat query dasar untuk mengambil data keuangan
        $queryFiltered = Keuangan::query();

        // 3. Menerapkan filter periode jika dipilih 'bulanan'
        if ($filterPeriode == 'bulanan') {
            $queryFiltered->whereMonth('tanggal', $selectedMonth)
                          ->whereYear('tanggal', $selectedYear);
        }
        // Jika $filterPeriode == 'semua', maka tidak ada filter tanggal tambahan,
        // sehingga semua transaksi akan diambil untuk perhitungan pemasukan/pengeluaran periode.
        $keuanganDataFiltered = $queryFiltered->get();

        // dd('Data Setelah Filter:', $keuanganDataFiltered->toArray());
        // 4. Menghitung TOTAL PEMASUKAN untuk periode yang difilter
        $totalPemasukan = $keuanganDataFiltered->where('jenis', 'pemasukan')->sum('jumlah');

        // 5. Menghitung TOTAL PENGELUARAN untuk periode yang difilter
        $totalPengeluaran = $keuanganDataFiltered->where('jenis', 'pengeluaran')->sum('jumlah');

        // 6. Menghitung SALDO KAS KESELURUHAN (tidak terpengaruh filter periode)
        $saldoPemasukanKeseluruhan = Keuangan::where('jenis', 'pemasukan')->sum('jumlah');
        $saldoPengeluaranKeseluruhan = Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $totalSaldo = $saldoPemasukanKeseluruhan - $saldoPengeluaranKeseluruhan;

        // 7. Membuat RINGKASAN BULANAN (misalnya untuk 12 bulan terakhir)
        $ringkasanBulanan = Keuangan::select(
                DB::raw('YEAR(tanggal) as tahun_angka'),
                DB::raw('MONTH(tanggal) as bulan_angka'),
                DB::raw('SUM(CASE WHEN jenis = "pemasukan" THEN jumlah ELSE 0 END) as total_pemasukan'),
                DB::raw('SUM(CASE WHEN jenis = "pengeluaran" THEN jumlah ELSE 0 END) as total_pengeluaran')
            )
            ->groupBy('tahun_angka', 'bulan_angka')
            ->orderBy('tahun_angka', 'desc')
            ->orderBy('bulan_angka', 'desc')
            ->limit(12) // Ambil 12 bulan terakhir dengan data
            ->get()
            ->map(function ($item) {
                // Format nama bulan dan tahun
                $item->bulan = Carbon::createFromDate($item->tahun_angka, $item->bulan_angka, 1)->translatedFormat('F Y');
                return $item;
            });

        // 8. Menyiapkan data untuk dropdown filter di view publik
        $availableYears = Keuangan::selectRaw('YEAR(tanggal) as tahun')
                                ->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[$m] = Carbon::create()->month($m)->locale('id')->monthName;
        }

        
        // 9. Mengirim semua data yang dibutuhkan ke view publik 'keuangan.index'
        return view('keuangan.index', compact( // Pastikan 'keuangan.index' adalah path ke view publik Anda
            'totalPemasukan',        // Akan Rp 0 jika tidak ada data untuk periode filter
            'totalPengeluaran',      // Akan Rp 0 jika tidak ada data untuk periode filter
            'totalSaldo',            // Saldo kas keseluruhan
            'ringkasanBulanan',
            'selectedMonth',
            'selectedYear',
            'filterPeriode',
            'availableYears',
            'months'
        ));
    }
}
