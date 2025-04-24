<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasPesawatTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_pesawat', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // Kolom untuk slug
            $table->string('nama_kelas'); // Kolom untuk nama kelas
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas_pesawat');
    }
}
