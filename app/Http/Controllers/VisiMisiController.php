<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function indexPublic()
    {
        $visiMisi = VisiMisi::all();
        return view('visi_misi.index', compact('visiMisi'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visiMisi = VisiMisi::all();
        return view('admin.visi_misi.index', compact('visiMisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.visi_misi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'visi' => 'required',
        'misi' => 'required',
    ]);

    $data = $request->all();
    $data['user_id'] = auth()->user()->id; // Menambahkan user_id berdasarkan user yang sedang login

    // Gunakan $data yang sudah berisi user_id
    VisiMisi::create($data);

    return redirect()->route('admin.visi_misi.index')
        ->with('success', 'Visi Misi berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     */
    public function show(VisiMisi $visiMisi)
    {
        return view('admin.visi_misi.show', compact('visiMisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisiMisi $visiMisi)
    {
        return view('admin.visi_misi.edit', compact('visiMisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        $request->validate([
            'visi' => 'required',
            'misi' => 'required',
        ]);

        $visiMisi->update($request->all());

        return redirect()->route('admin.visi_misi.index')
            ->with('success', 'Visi Misi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisiMisi $visiMisi)
    {
        $visiMisi->delete();

        return redirect()->route('admin.visi_misi.index')
            ->with('success', 'Visi Misi berhasil dihapus.');
    }
}