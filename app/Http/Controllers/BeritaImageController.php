<?php

namespace App\Http\Controllers;

use App\Models\BeritaImage;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritaImages = BeritaImage::all();
        return view('admin.berita_images.index', compact('beritaImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $beritas = Berita::all();
        return view('admin.berita_images.create', compact('beritas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'berita_id' => 'required|exists:beritas,id',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $imagePath = $request->file('image_path')->store('berita_images', 'public');

        BeritaImage::create([
            'berita_id' => $request->berita_id,
            'image_path' => $imagePath,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.berita_images.index')
            ->with('success', 'Gambar berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BeritaImage $beritaImage)
    {
        return view('admin.berita_images.show', compact('beritaImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BeritaImage $beritaImage)
    {
        $beritas = Berita::all();
        return view('admin.berita_images.edit', compact('beritaImage', 'beritas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BeritaImage $beritaImage)
    {
        $request->validate([
            'berita_id' => 'required|exists:beritas,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_path')) {
            Storage::disk('public')->delete($beritaImage->image_path);
            $imagePath = $request->file('image_path')->store('berita_images', 'public');
            $data['image_path'] = $imagePath;
        }

        $beritaImage->update($data);

        return redirect()->route('admin.berita_images.index')
            ->with('success', 'Gambar berita berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BeritaImage $beritaImage)
    {
        Storage::disk('public')->delete($beritaImage->image_path);
        $beritaImage->delete();

        return redirect()->route('admin.berita_images.index')
            ->with('success', 'Gambar berita berhasil dihapus.');
    }
}       