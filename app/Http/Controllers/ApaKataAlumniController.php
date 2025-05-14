<?php

namespace App\Http\Controllers;

use App\Models\ApaKataAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApaKataAlumniController extends Controller
{
    public function indexPublic()
    {
        $apaKataAlumni = ApaKataAlumni::all();
        return view('apa_kata_alumni.index', compact('apaKataAlumni'));
    }

    public function index()
    {
        $apaKataAlumni = ApaKataAlumni::all();
        return view('admin.apa_kata_alumni.index', compact('apaKataAlumni'));
    }

    public function create()
    {
        return view('admin.apa_kata_alumni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'angkatan' => 'required|integer',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $pathGambar = $gambar->storeAs('alumni', $namaGambar, 'public'); // Simpan di storage/app/public/apa_kata_alumni
            $data['gambar'] = $pathGambar;
        }

        $data['user_id'] = auth()->user()->id; // Menambahkan user_id berdasarkan user yang sedang login

        ApaKataAlumni::create($data);

        return redirect()->route('admin.apa_kata_alumni.index')
            ->with('success', 'Apa Kata Alumni berhasil ditambahkan.');
    }

    public function show(ApaKataAlumni $apaKataAlumni)
    {
        return view('admin.apa_kata_alumni.show', compact('apaKataAlumni'));
    }

    public function edit(ApaKataAlumni $apaKataAlumni)
    {
        return view('admin.apa_kata_alumni.edit', compact('apaKataAlumni'));
    }

    public function update(Request $request, ApaKataAlumni $apaKataAlumni)
    {
        $request->validate([
            'nama' => 'required',
            'angkatan' => 'required|integer',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($apaKataAlumni->gambar) {
                Storage::delete('public/' . $apaKataAlumni->gambar);
            }

            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $pathGambar = $gambar->storeAs('apa_kata_alumni', $namaGambar, 'public');
            $data['gambar'] = $pathGambar;
        }

        $apaKataAlumni->update($data);

        return redirect()->route('admin.apa_kata_alumni.index')
            ->with('success', 'Apa Kata Alumni berhasil diperbarui.');
    }

    public function destroy(ApaKataAlumni $apaKataAlumni)
    {
        // Hapus gambar terkait jika ada
        if ($apaKataAlumni->gambar) {
            Storage::delete('public/' . $apaKataAlumni->gambar);
        }

        $apaKataAlumni->delete();

        return redirect()->route('admin.apa_kata_alumni.index')
            ->with('success', 'Apa Kata Alumni berhasil dihapus.');
    }
}
