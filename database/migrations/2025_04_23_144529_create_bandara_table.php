<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBandaraTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bandara', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // Kolom untuk slug
            $table->string('nama_bandara'); // Kolom untuk nama bandara
            $table->decimal('latitude', 10, 7); // Kolom untuk latitude
            $table->decimal('longitude', 10, 7); // Kolom untuk longitude
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
        Schema::dropIfExists('bandara');
    }
}
