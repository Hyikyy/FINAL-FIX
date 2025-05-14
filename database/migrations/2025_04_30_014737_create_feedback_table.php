<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('berita_id'); // Foreign key ke tabel beritas
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users (WAJIB LOGIN)
            $table->string('nama'); //nama user yang memberi feedback
            $table->dateTime('tanggal'); // tanggal feedback diberikan
            $table->text('isi'); //isi feedback
            $table->timestamps();

            $table->foreign('berita_id')->references('id')->on('beritas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //menghapus feedback jika user dihapus
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}