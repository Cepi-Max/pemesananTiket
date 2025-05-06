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
            $table->unsignedBigInteger('id_orderer')->nullable(); // Kolom untuk id_orderer (foreign key ke user)
            $table->unsignedBigInteger('id_penerbangan'); // Kolom untuk id_penerbangan (foreign key ke penerbangan)
            $table->decimal('total_harga', 15, 2); // Kolom untuk total harga
            $table->string('status')->default('pending'); // Kolom untuk status
            $table->string('nama_pemesan')->nullable();
            $table->string('email_pemesan')->nullable();
            $table->string('telp_pemesan')->nullable();
            $table->enum('gender_pemesan', ['L', 'P'])->nullable();
            $table->timestamps();

            // Menambahkan foreign key untuk relasi ke tabel user
            $table->foreign('id_orderer')->references('id')->on('users')->onDelete('cascade');
            
            // Menambahkan foreign key untuk relasi ke tabel penerbangan
            $table->foreign('id_penerbangan')->references('id')->on('penerbangan')->onDelete('cascade');
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
