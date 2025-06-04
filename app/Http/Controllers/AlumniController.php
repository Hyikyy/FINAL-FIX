<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnis = Alumni::all(); // Ambil semua data alumni
        return view('admin.alumnis.index', compact('alumnis')); // Kirim data ke view
    }

    public function indexPublic(Request $request)
    {
        // Ambil daftar tahun angkatan yang unik dan tidak null, urutkan dari terbaru
        $angkatans = Alumni::select('angkatan')
                            ->whereNotNull('angkatan')
                            ->distinct()
                            ->orderBy('angkatan', 'desc')
                            ->pluck('angkatan'); // pluck hanya mengambil kolom 'angkatan'

        // Query dasar untuk alumni
        $query = Alumni::query();

        // Filter berdasarkan angkatan jika ada di request
        $selectedAngkatan = $request->query('angkatan'); // Ambil 'angkatan' dari URL query string

        if ($selectedAngkatan) {
            $query->where('angkatan', $selectedAngkatan);
        }

        // Ambil data alumni yang sudah difilter atau semua jika tidak ada filter
        // Urutkan berdasarkan nama atau angkatan, sesuaikan
        $alumnis = $query->orderBy('angkatan', 'desc')->orderBy('nama', 'asc')->paginate(12); // Contoh paginasi 12 item

        // Pertahankan query string (filter angkatan) pada link paginasi
        $alumnis->appends($request->query());

        return view('alumni.index', compact('alumnis', 'angkatans', 'selectedAngkatan'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.alumnis.create'); // Tampilkan form untuk membuat alumni baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nama_cantik' => 'nullable',
            'angkatan' => 'nullable|integer|min:1900|max:' . (date('Y') + 5), // Validasi untuk tahun angkatan
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
            'teaching_asisten' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $pathGambar = $gambar->storeAs('public/alumni', $namaGambar); // Simpan gambar di storage/app/public/alumni
            $data['gambar'] = str_replace('public/', '', $pathGambar); // Simpan path relatif ke database
        }

        $data = $request->all();
    $data['user_id'] = auth()->user()->id; // Menambahkan user_id berdasarkan user yang sedang login

        Alumni::create($data);

        return redirect()->route('admin.alumnis.index')
            ->with('success', 'Daftar Alumni berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumni)
    {
        return view('admin.alumnis.show', compact('alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumni)
    {
        return view('admin.alumnis.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumni $alumni)
    {
        $request->validate([
            'nama' => 'required',
            'nama_cantik' => 'nullable',
            'angkatan' => 'nullable|integer|min:1900|max:' . (date('Y') + 5), // Validasi untuk tahun angkatan
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
            'teaching_asisten' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($alumni->gambar) {
                Storage::delete('public/' . $alumni->gambar);
            }

            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $pathGambar = $gambar->storeAs('public/alumni', $namaGambar);
            $data['gambar'] = str_replace('public/', '', $pathGambar);
        }

        $alumni->update($data);

        return redirect()->route('admin.alumnis.index')
            ->with('success', 'Daftar Alumni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumni)
    {
        // Hapus gambar jika ada
        if ($alumni->gambar) {
            Storage::delete('public/' . $alumni->gambar);
        }

        $alumni->delete();

        return redirect()->route('admin.alumnis.index')
            ->with('success', 'Daftar Alumni berhasil dihapus.');
    }

    /**
     * Display the specified resource for public viewing.
     */
    public function showPublic(Alumni $alumni)
    {
        return view('alumni.show_public', ['alumni' => $alumni]);

    }

    public function showPublicDetail(Alumni $alumni)
    {
        // $alumni sudah di-inject
        return view('alumni.show', compact('alumni'));
    }
}
