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
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Tanggal transaksi
            $table->string('deskripsi'); // Keterangan transaksi
            $table->decimal('jumlah', 15, 2); // Jumlah uang, selalu positif
            $table->enum('jenis', ['pemasukan', 'pengeluaran']); // Jenis transaksi
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // ID user yang mencatat/mengelola
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan');
    }
};
