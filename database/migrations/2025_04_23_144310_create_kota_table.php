<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKotaTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kota', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // Kolom untuk slug
            $table->string('nama_kota'); // Kolom untuk nama kota
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
        Schema::dropIfExists('kota');
    }
}
