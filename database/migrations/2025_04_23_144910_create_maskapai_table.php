<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaskapaiTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maskapai', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // Kolom untuk slug
            $table->string('nama_maskapai'); // Kolom untuk nama maskapai
            $table->string('logo')->default('default.jpg'); // Kolom untuk logo, dengan default 'default.jpg'
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
        Schema::dropIfExists('maskapai');
    }
}
