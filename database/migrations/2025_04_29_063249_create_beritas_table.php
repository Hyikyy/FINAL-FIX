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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('judul');
            $table->date('tanggal');
            $table->text('deskripsi');
            $table->string('gambar')->nullable(); // Bisa null jika tidak ada file
            $table->timestamps();
        
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};