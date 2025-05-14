<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Dosen;
use App\Models\TeachingAssistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens = Dosen::all();
        return view('admin.dosens.index', compact('dosens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dosens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nama_jabatan' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_jabatan' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('public/images', $namaGambar); // Simpan di storage/app/public/images
            $data['gambar'] = $namaGambar;  // Simpan nama file saja di database
        }

        $data = $request->all();
    $data['user_id'] = auth()->user()->id; // Menambahkan user_id berdasarkan user yang sedang login

        Dosen::create($data);

        return redirect()->route('admin.dosens.index')
            ->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        return view('admin.dosens.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('admin.dosens.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama' => 'required',
            'nama_jabatan' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_jabatan' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('public/images', $namaGambar);
            $data['gambar'] = $namaGambar;

            // Hapus gambar lama jika ada
            if ($dosen->gambar) {
                Storage::delete('public/images/' . $dosen->gambar);
            }
        }

        $dosen->update($data);

        return redirect()->route('admin.dosens.index')
            ->with('success', 'Dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        // Hapus gambar jika ada
        if ($dosen->gambar) {
            Storage::delete('public/images/' . $dosen->gambar);
        }

        $dosen->delete();

        return redirect()->route('admin.dosens.index')
            ->with('success', 'Dosen berhasil dihapus.');
    }

    /**
     * Display the specified resource for public viewing.
     */
    public function showPublic()
    {
        $alumnis = Alumni::all();
        $teachingAssistants = TeachingAssistant::all();
        $dosens = Dosen::all();
        return view('dosens.index', compact('dosens', 'teachingAssistants', 'alumnis'));
    }
}