<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // Kolom untuk slug
            $table->string('kode_promo'); // Kolom untuk kode promo
            $table->decimal('jumlah_persen', 5, 2)->nullable(); // Kolom untuk jumlah % (nullable)
            $table->decimal('jumlah_rp', 15, 2)->nullable(); // Kolom untuk jumlah Rp (nullable)
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
        Schema::dropIfExists('promo');
    }
}
