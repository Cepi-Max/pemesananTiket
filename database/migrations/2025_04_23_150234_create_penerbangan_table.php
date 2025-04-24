<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerbanganTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerbangan', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // Kolom untuk slug
            $table->date('tanggal_berangkat'); // Kolom untuk tanggal berangkat
            $table->date('tanggal_tiba'); // Kolom untuk tanggal tiba
            $table->time('jam_berangkat'); // Kolom untuk jam berangkat
            $table->unsignedBigInteger('id_bandara_asal'); // Kolom untuk id_bandara_asal (foreign key ke bandara)
            $table->unsignedBigInteger('id_bandara_tujuan'); // Kolom untuk id_bandara_tujuan (foreign key ke bandara)
            $table->unsignedBigInteger('id_pesawat'); // Kolom untuk id_pesawat (foreign key ke pesawat)
            $table->integer('maks_penumpang'); // Kolom untuk maksimum penumpang
            $table->decimal('harga_dewasa', 15, 2); // Kolom untuk harga dewasa
            $table->decimal('harga_anak', 15, 2); // Kolom untuk harga anak
            $table->timestamps();

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
        Schema::dropIfExists('penerbangan');
    }
}
