<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenumpangTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penumpang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemesanan_tiket'); // Kolom untuk id_pemesanan_tiket (foreign key ke pesan_tiket)
            $table->string('nama_penumpang'); // Kolom untuk nama penumpang
            $table->enum('jenis_kelamin', ['L', 'P']); // Kolom untuk jenis kelamin (L: Laki-laki, P: Perempuan)
            $table->enum('tipe_penumpang', ['dewasa', 'anak-anak']); // Kolom untuk tipe penumpang (dewasa atau anak-anak)
            $table->timestamps();

            // Menambahkan foreign key untuk relasi ke tabel pesan_tiket
            $table->foreign('id_pemesanan_tiket')->references('id')->on('pesan_tiket')->onDelete('cascade');
        });
    }

    /**
     * Membatalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penumpang');
    }
}
