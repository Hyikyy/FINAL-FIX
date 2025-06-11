<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama' => 'Semua'],
            ['nama' => 'Artikel'],
            ['nama' => 'Hari Besar'],
            ['nama' => 'Kegiatan'],
            ['nama' => 'Pengumuman'],
            ['nama' => 'Wisuda'],
        ];

        foreach ($categories as $categoryData) {
            Category::create([
                'nama' => $categoryData['nama'],
                'slug' => Str::slug($categoryData['nama']),
            ]);
        }
    }
}