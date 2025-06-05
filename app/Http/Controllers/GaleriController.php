<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function showPublic(Request $request)
    {
        // 1. Ambil SEMUA kategori untuk ditampilkan di filter
        $kategoriGaleris = KategoriGaleri::orderBy('nama_kategori')->get();
        // dd($kategoriGaleris); // DEBUGGING POINT A: Apakah di sini $kategoriGaleris punya isi? Seharusnya ada 2.

        $selectedKategori = null;
        $judulHalaman = '📸 Jelajahi Galeri HIMATIF';

        $query = Galeri::query()->with('kategoriGaleri')->latest();

        // 2. Filter galeri berdasarkan query string 'kategori' jika ada (untuk link seperti /galeri?kategori=slug-kategori)
        // Ini adalah salah satu cara filter. Cara lain adalah route terpisah /galeri/kategori/{slug} yang ditangani showByCategory
        if ($request->has('kategori') && $request->kategori != '') {
            $slugKategori = $request->kategori;
            $selectedKategori = KategoriGaleri::where('slug', $slugKategori)->first();
            if ($selectedKategori) {
                $query->where('kategori_galeri_id', $selectedKategori->id);
                $judulHalaman = 'Galeri Kategori: ' . $selectedKategori->nama_kategori;
            }
            // Jika slug kategori dari query string tidak ditemukan, $selectedKategori akan null,
            // dan $query tidak akan difilter berdasarkan kategori_galeri_id, jadi menampilkan semua galeri.
        }

        $galeris = $query->paginate(12)->appends($request->query());

        // dd($kategoriGaleris, $galeris, $selectedKategori); // DEBUGGING POINT B: Cek semua variabel sebelum dikirim ke view

        return view('galeri.index', compact(
            'galeris',
            'kategoriGaleris', // Pastikan ini dikirim
            'selectedKategori',
            'judulHalaman'
        ));
    }


    public function showByCategory($kategoriSlug) // Parameter $kategoriSlug akan diisi dari URL
    {
        $kategoriGaleris = KategoriGaleri::orderBy('nama_kategori')->get();
        $selectedKategori = KategoriGaleri::where('slug', $kategoriSlug)->firstOrFail();
        $judulHalaman = 'Galeri Kategori: ' . $selectedKategori->nama_kategori;
        $galeris = Galeri::where('kategori_galeri_id', $selectedKategori->id)
                         ->with('kategoriGaleri')
                         ->latest()
                         ->paginate(12);

        return view('galeri.index', compact('galeris', 'kategoriGaleris', 'selectedKategori', 'judulHalaman'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $query = Galeri::with('kategoriGaleri', 'user')->latest();

    if($request->filled('kategori_filter')) {
        $query->where('kategori_galeri_id', $request->kategori_filter);
    }
    if($request->filled('search')) {
        $query->where('judul', 'like', '%' . $request->search . '%');
    }

    // GANTI INI:
    // $galeris = $query->paginate(10)->appends($request->query());
    // MENJADI INI:
    $galeris = $query->paginate(10);

    $kategoris = KategoriGaleri::orderBy('nama_kategori')->get(); // Untuk filter

    return view('admin.galeri.index', compact('galeris', 'kategoris'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = KategoriGaleri::orderBy('nama_kategori')->get();
        return view('admin.galeri.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request) // Parameter $request sudah benar
    {
        // Validasi data dari $request
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'kategori_galeri_id' => 'required|exists:kategori_galeris,id',
            'deskripsi_gambar' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            // Mengambil file dari $request
            $path = $request->file('gambar')->store('galeri_images', 'public');
        }

        // Membuat record baru menggunakan data dari $request (atau $validatedData)
        Galeri::create([
            'judul' => $validatedData['judul'], // AMBIL DARI $validatedData ATAU $request->input('judul')
            'gambar' => $path,
            'kategori_galeri_id' => $validatedData['kategori_galeri_id'], // AMBIL DARI $validatedData ATAU $request->input('kategori_galeri_id')
            'deskripsi_gambar' => $validatedData['deskripsi_gambar'] ?? null, // AMBIL DARI $validatedData ATAU $request->input('deskripsi_gambar')
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        $galeri->load('kategoriGaleri', 'user');
        return view('admin.galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        $kategoris = KategoriGaleri::orderBy('nama_kategori')->get();
        return view('admin.galeri.edit', compact('galeri', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
       $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Gambar opsional saat update
            'kategori_galeri_id' => 'required|exists:kategori_galeris,id',
            'deskripsi_gambar' => 'nullable|string',
        ]);

        $data = $request->only(['judul', 'kategori_galeri_id', 'deskripsi_gambar']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galeri_images', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeri $galeri)
    {
        // Hapus gambar
        if ($galeri->gambar) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}
