<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function indexPublic()
    {
        $totalPemasukan = Keuangan::sum('pemasukan');
        $totalPengeluaran = Keuangan::sum('pengeluaran');

        return view('keuangan.index', compact('totalPemasukan', 'totalPengeluaran'));
    }

    public function index()
    {
        $keuangan = Keuangan::all();
        return view('admin.keuangan.index', compact('keuangan'));
    }

    public function create()
    {
        return view('admin.keuangan.create');
    }

    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'pemasukan' => 'required|numeric',
        'pengeluaran' => 'required|numeric',
        'saldo' => 'required|numeric',
        'laporan' => 'nullable|string',
    ]);

    // Ambil semua data yang diterima dari request
    $data = $request->all();

    // Menambahkan user_id berdasarkan user yang sedang login
    $data['user_id'] = auth()->user()->id;

    // Simpan data ke tabel 'keuangan'
    Keuangan::create($data);

    // Redirect dengan pesan sukses
    return redirect()->route('admin.keuangan.index')
        ->with('success', 'Data keuangan berhasil ditambahkan.');
}


    public function show(Keuangan $keuangan)
    {
        return view('admin.keuangan.show', compact('keuangan'));
    }

    public function edit(Keuangan $keuangan)
    {
        return view('admin.keuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'pemasukan' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'saldo' => 'required|numeric',
            'laporan' => 'nullable|string',
        ]);

        $keuangan->update($request->all());

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Data keuangan berhasil diperbarui.');
    }

    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Data keuangan berhasil dihapus.');
    }
}