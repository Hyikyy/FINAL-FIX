<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_galeris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->unique(); // Nama kategori harus unik
            $table->string('slug')->unique();         // Untuk URL yang ramah SEO
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_galeris');
    }
};
