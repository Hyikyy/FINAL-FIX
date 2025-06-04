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
            if (Schema::hasColumn('galeris', 'gambar')) {
                 $table->foreignId('kategori_galeri_id')->nullable()->after('gambar')->constrained('kategori_galeris')->onDelete('set null');
            } else if (Schema::hasColumn('galeris', 'judul')) {
                 $table->foreignId('kategori_galeri_id')->nullable()->after('judul')->constrained('kategori_galeris')->onDelete('set null');
            }
            else {
                 $table->foreignId('kategori_galeri_id')->nullable()->constrained('kategori_galeris')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
             if (Schema::hasColumn('galeris', 'kategori_galeri_id')) {
                // Coba cara umum dulu
                try {
                    $table->dropForeign(['kategori_galeri_id']);
                } catch (\Exception $e) {
                    // Jika gagal, mungkin nama constraint berbeda, coba ini (sesuaikan nama tabel_kolom_foreign)
                    // $table->dropForeign('nama_constraint_foreign_key_anda');
                    // Untuk menemukan nama constraint: SHOW CREATE TABLE galeris; di SQL client
                    logger("Gagal drop foreign key 'kategori_galeri_id': " . $e->getMessage());
                }
                $table->dropColumn('kategori_galeri_id');
            }
        });
    }
};
