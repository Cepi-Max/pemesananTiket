<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanTiketTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_tiket', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique(); // Kolom untuk kode booking
            $table->unsignedBigInteger('id_orderer'); // Kolom untuk id_orderer (foreign key ke user)
            $table->unsignedBigInteger('id_penerbangan'); // Kolom untuk id_penerbangan (foreign key ke penerbangan)
            $table->date('tanggal_berangkat'); // Kolom untuk tanggal berangkat
            $table->date('tanggal_tiba'); // Kolom untuk tanggal tiba
            $table->time('jam_berangkat'); // Kolom untuk jam berangkat
            $table->unsignedBigInteger('id_bandara_asal'); // Kolom untuk id_bandara_asal (foreign key ke bandara)
            $table->unsignedBigInteger('id_bandara_tujuan'); // Kolom untuk id_bandara_tujuan (foreign key ke bandara)
            $table->unsignedBigInteger('id_pesawat'); // Kolom untuk id_pesawat (foreign key ke pesawat)
            $table->decimal('total_harga', 15, 2); // Kolom untuk total harga
            $table->string('status'); // Kolom untuk status
            $table->timestamps();

            // Menambahkan foreign key untuk relasi ke tabel user
            $table->foreign('id_orderer')->references('id')->on('users')->onDelete('cascade');
            
            // Menambahkan foreign key untuk relasi ke tabel penerbangan
            $table->foreign('id_penerbangan')->references('id')->on('penerbangan')->onDelete('cascade');
            
            // Menambahkan foreign key untuk relasi ke tabel bandara (asal)
            $table->foreign('id_bandara_asal')->references('id')->on('bandara')->onDelete('cascade');
            
            // Menambahkan foreign key untuk relasi ke tabel bandara (tujuan)
            $table->foreign('id_bandara_tujuan')->references('id')->on('bandara')->onDelete('cascade');
            
            // Menambahkan foreign key untuk relasi ke tabel pesawat
            $table->foreign('id_pesawat')->references('id')->on('pesawat')->onDelete('cascade');
        });
    }

    /**
     * Membatalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesan_tiket');
    }
}
