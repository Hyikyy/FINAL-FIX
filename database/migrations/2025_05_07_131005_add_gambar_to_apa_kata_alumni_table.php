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
        Schema::table('apa_kata_alumni', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('isi'); // Kolom gambar, boleh kosong
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apa_kata_alumni', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};