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

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('public/teaching_assistants', $namaGambar); // Simpan di storage/app/public/teaching_assistants
            $data['gambar'] = $namaGambar;
        }

        $data = $request->all();
    $data['user_id'] = auth()->user()->id; // Menambahkan user_id berdasarkan user yang sedang login

        TeachingAssistant::create($data);

        return redirect()->route('admin.teaching_assistants.index')
            ->with('success', 'Asisten Dosen berhasil ditambahkan.');
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
            ->with('success', 'Asisten Dosen berhasil diperbarui.');
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
            ->with('success', 'Asisten Dosen berhasil dihapus.');
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