<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $strukturOrganisasi = StrukturOrganisasi::all();

        return view('admin.struktur_organisasi.index', compact('strukturOrganisasi')); // Admin view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.struktur_organisasi.create'); // Admin view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama_anggota' => 'required',
        'nama_jabatan' => 'required',
        'periode' => 'required',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        'deskripsi_jabatan' => 'nullable',
    ]);

    $data = $request->all();
    $data['user_id'] = auth()->user()->id; // Menambahkan user_id berdasarkan user yang sedang login

    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs('public/struktur_organisasi', $namaGambar); // Simpan di storage/app/public/struktur_organisasi
        $data['gambar'] = $namaGambar; // Simpan nama file di database
    }

    StrukturOrganisasi::create($data);

    return redirect()->route('admin.struktur-organisasi.index')
         ->with('success', 'Data struktur organisasi berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     */
    public function show(StrukturOrganisasi $strukturOrganisasi)
    {
        return view('admin.struktur_organisasi.show', compact('strukturOrganisasi')); // Admin view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StrukturOrganisasi $strukturOrganisasi)
    {
        return view('admin.struktur_organisasi.edit', compact('strukturOrganisasi')); // Admin view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StrukturOrganisasi $strukturOrganisasi)
    {
        $request->validate([
            'nama_anggota' => 'required',
            'nama_jabatan' => 'required',
            'periode' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
            'deskripsi_jabatan' => 'nullable',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($strukturOrganisasi->gambar) {
                Storage::delete('public/struktur_organisasi/' . $strukturOrganisasi->gambar);
            }

            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('public/struktur_organisasi', $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        $strukturOrganisasi->update($data);

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data struktur organisasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StrukturOrganisasi $strukturOrganisasi)
    {
        // Hapus gambar jika ada
        if ($strukturOrganisasi->gambar) {
            Storage::delete('public/struktur_organisasi/' . $strukturOrganisasi->gambar);
        }

        $strukturOrganisasi->delete();

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data struktur organisasi berhasil dihapus.');
    }

    /**
     * Show the structure organization for public view.
     */
    public function showPublic()
    {
        $strukturOrganisasi = StrukturOrganisasi::all();
        $visiMisi = VisiMisi::all();
        return view('struktur_organisasi.index', [
            'strukturOrganisasi' => $strukturOrganisasi,
            'visiMisi' => $visiMisi // Kirim data visiMisi ke view
        ]); // Public view
    }
}
