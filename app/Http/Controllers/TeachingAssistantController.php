<?php

namespace App\Http\Controllers;

use App\Models\TeachingAssistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import untuk mengelola file

class TeachingAssistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachingAssistants = TeachingAssistant::all();
        return view('admin.teaching_assistants.index', compact('teachingAssistants'));
    }

    public function indexPublic()
    {
        // Ambil data teaching assistants dari database
        // Contoh: ambil semua TA yang aktif dan urutkan berdasarkan nama

        $teachingAssistants = TeachingAssistant::all();

        return view('teaching_assistants.index', compact('teachingAssistants'));

        // Alternatif jika tidak ada data spesifik, hanya halaman statis:
        // return view('public.teaching_assistants.index');
    }


    public function showPublicDetail(TeachingAssistant $teachingAssistant)
    {
        // Variabel $teachingAssistant sudah otomatis di-inject oleh Laravel
        // berdasarkan parameter rute (misalnya {teachingAssistant}).
        // Jika TA dengan ID/slug yang diberikan tidak ditemukan, Laravel akan
        // otomatis menampilkan error 404.

        // Anda bisa menambahkan logika di sini jika perlu mengambil data relasi,
        // meskipun untuk halaman detail sederhana biasanya tidak perlu jika field
        // sudah ada di model utama.
        // Contoh: $teachingAssistant->load('matakuliahYangDiampu');

        
        return view('teaching_assistants.show', compact('teachingAssistant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teaching_assistants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nama_jabatan' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
            'deskripsi_jabatan' => 'required',
        ]);

        $data = $request->all();

        // Di store() dan update()
if ($request->hasFile('gambar')) {
    // ... (logika hapus gambar lama untuk update) ...
    $pathRelatifDariPublicDisk = $request->file('gambar')->store('ta_fotos', 'public'); // Simpan ke storage/app/public/ta_fotos
    $data['gambar'] = $pathRelatifDariPublicDisk;
}

        $data = $request->all();
    $data['user_id'] = auth()->user()->id; // Menambahkan user_id berdasarkan user yang sedang login

        TeachingAssistant::create($data);

        return redirect()->route('admin.teaching_assistants.index')
            ->with('success', 'Daftar Asisten Dosen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeachingAssistant  $teachingAssistant
     * @return \Illuminate\Http\Response
     */
    public function show(TeachingAssistant $teachingAssistant)
    {
        return view('admin.teaching_assistants.show', compact('teachingAssistant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeachingAssistant  $teachingAssistant
     * @return \Illuminate\Http\Response
     */
    public function edit(TeachingAssistant $teachingAssistant)
    {
        return view('admin.teaching_assistants.edit', compact('teachingAssistant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeachingAssistant  $teachingAssistant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeachingAssistant $teachingAssistant)
    {
        $request->validate([
            'nama' => 'required',
            'nama_jabatan' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
            'deskripsi_jabatan' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($teachingAssistant->gambar) {
                Storage::delete('public/teaching_assistants/' . $teachingAssistant->gambar);
            }

            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('public/teaching_assistants', $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        $teachingAssistant->update($data);

        return redirect()->route('admin.teaching_assistants.index')
            ->with('success', 'Daftar Asisten Dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeachingAssistant  $teachingAssistant
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeachingAssistant $teachingAssistant)
    {
        // Hapus gambar jika ada
        if ($teachingAssistant->gambar) {
            Storage::delete('public/teaching_assistants/' . $teachingAssistant->gambar);
        }

        $teachingAssistant->delete();

        return redirect()->route('admin.teaching_assistants.index')
            ->with('success', 'Daftar Asisten Dosen berhasil dihapus.');
    }

    /**
     * Display the specified resource for public view.
     *
     * @param  \App\Models\TeachingAssistant  $teachingAssistant
     * @return \Illuminate\Http\Response
     */
    public function showPublic(TeachingAssistant $teachingAssistant)
    {

        return view('teaching_assistants.show_public', compact('teachingAssistant'));
    }
}
