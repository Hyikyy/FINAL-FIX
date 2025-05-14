<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Feedback; // Import model Feedback
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import untuk file storage

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource (Admin).
     */
    public function index()
    {
        $beritas = Berita::all();
        return view('admin.beritas.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource (Admin).
     */
    public function create()
    {
        return view('admin.beritas.create');
    }

    /**
     * Store a newly created resource in storage (Admin).
     */
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'tanggal' => 'required|date',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'deskripsi' => 'required',
    ]);

    $data = $request->all();

    // Tambahkan user_id
    $data['user_id'] = auth()->id();

    // Handle upload file jika ada
    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('gambar', $fileName, 'public');
        $data['gambar'] = $path;
    }

    Berita::create($data);

    return redirect()->route('admin.beritas.index')
        ->with('success', 'Berita berhasil ditambahkan.');
}


    /**
     * Display the specified resource (Admin).
     */
    public function show(Berita $berita)
    {
        $recentBeritas = Berita::orderBy('tanggal', 'desc')->limit(5)->get();
        $relatedBeritas = Berita::where('id', '!=', $berita->id)
                             ->where('keywords', 'like', '%'.$berita->keywords.'%')
                             ->limit(3)
                             ->get();
        //Eager load feedback dengan eager load user
        $berita->load('feedback.user');
        return view('beritas.show', compact('berita', 'recentBeritas','relatedBeritas'));
    }

    /**
     * Show the form for editing the specified resource (Admin).
     */
    public function edit(Berita $berita)
    {
        return view('admin.beritas.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage (Admin).
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Contoh validasi file
            'deskripsi' => 'required',
        ]);

        $data = $request->all();

        // Handle upload file jika ada (update)
        if ($request->hasFile('gambar')) {
            // Hapus file lama jika ada
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('gambar', $fileName, 'public');
            $data['gambar'] = $path;
        }

        $berita->update($data);

        return redirect()->route('admin.beritas.index')
            ->with('success', 'Berita berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage (Admin).
     */
    public function destroy(Berita $berita)
    {
        // Hapus file jika ada
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.beritas.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Display the specified resource (Public).
     */
    public function showPublic()
    {
        $beritas = Berita::all();
        return view('beritas.index', compact('beritas'));
    }
}