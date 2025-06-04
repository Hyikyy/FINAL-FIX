<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('nama_kategori')->get();
    return view('admin.beritas.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Dalam method store()
// ... setelah $berita = Berita::create($data); ...
if ($request->has('categories')) {
    $berita->categories()->sync($request->categories); // categories adalah nama input dari form
} else {
    $berita->categories()->detach(); // Hapus semua kategori jika tidak ada yang dipilih
}

// Dalam method update()
// ... setelah $berita->update($data); ...
if ($request->has('categories')) {
    $berita->categories()->sync($request->categories);
} else {
    $berita->categories()->detach();
}
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::orderBy('nama_kategori')->get();
    return view('admin.beritas.edit', compact('berita', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    
}
