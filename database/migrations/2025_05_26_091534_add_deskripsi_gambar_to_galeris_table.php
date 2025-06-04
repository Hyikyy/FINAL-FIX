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
        Schema::table('galeris', function (Blueprint $table) {
            if (Schema::hasColumn('galeris', 'kategori_galeri_id')) {
                $table->text('deskripsi_gambar')->nullable()->after('kategori_galeri_id');
            } else if (Schema::hasColumn('galeris', 'gambar')) {
                $table->text('deskripsi_gambar')->nullable()->after('gambar');
            }
            else {
                $table->text('deskripsi_gambar')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
             if (Schema::hasColumn('galeris', 'deskripsi_gambar')) {
                $table->dropColumn('deskripsi_gambar');
            }
        });
    }
};
