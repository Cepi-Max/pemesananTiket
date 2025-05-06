<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesawatTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesawat', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // Kolom untuk slug
            $table->string('kode_pesawat'); // Kolom untuk kode pesawat
            $table->unsignedBigInteger('id_maskapai'); // Kolom untuk id_maskapai (foreign key ke maskapai)
            $table->unsignedBigInteger('id_kelas'); // Kolom untuk id_kelas (foreign key ke kelas_transportasi)
            $table->integer('jumlah_kursi'); // Kolom untuk jumlah kursi
            $table->timestamps();

            // Menambahkan foreign key untuk relasi ke tabel maskapai
            $table->foreign('id_maskapai')->references('id')->on('maskapai')->onDelete('cascade');
            
            // Menambahkan foreign key untuk relasi ke tabel kelas_transportasi
            $table->foreign('id_kelas')->references('id')->on('kelas_pesawat')->onDelete('cascade');
        });
    }

    /**
     * Membatalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesawat');
    }
}
