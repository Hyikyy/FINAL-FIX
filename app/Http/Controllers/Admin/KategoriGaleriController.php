<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = KategoriGaleri::withCount('galeris')->latest()->paginate(10);
        return view('admin.galeri_kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galeri_kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_galeris,nama_kategori',
            'slug' => 'nullable|string|max:255|unique:kategori_galeris,slug',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriGaleri::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => $request->slug ?: Str::slug($request->nama_kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.galeri-kategori.index')->with('success', 'Kategori galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriGaleri $kategoriGaleri)
    {
         $kategoriGaleri->load('galeris');
        return view('admin.galeri_kategori.show', compact('kategoriGaleri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriGaleri $kategoriGaleri)
    {
        return view('admin.galeri_kategori.edit', compact('kategoriGaleri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriGaleri $kategoriGaleri)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_galeris,nama_kategori,' . $kategoriGaleri->id,
            'slug' => 'nullable|string|max:255|unique:kategori_galeris,slug,' . $kategoriGaleri->id,
            'deskripsi' => 'nullable|string',
        ]);

        // Menggunakan flag untuk menandakan slug diisi manual atau tidak
        // $kategoriGaleri->slug_manually_set = !empty($request->slug);

        $kategoriGaleri->update([
            'nama_kategori' => $request->nama_kategori,
            'slug' => $request->slug ?: Str::slug($request->nama_kategori), // Jika slug kosong, buat dari nama
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.galeri-kategori.index')->with('success', 'Kategori galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriGaleri $kategoriGaleri)
    {
        if ($kategoriGaleri->galeris()->count() > 0) {
            return redirect()->route('admin.galeri-kategori.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki item galeri.');
        }
        $kategoriGaleri->delete();
        return redirect()->route('admin.galeri-kategori.index')->with('success', 'Kategori galeri berhasil dihapus.');
    }

    public function getRouteKeyName()
{
    return 'slug';
}
}
