<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerbanganPromoTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerbangan_promo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_id')->constrained('promo')->onDelete('cascade'); 
            $table->foreignId('penerbangan_id')->constrained('penerbangan')->onDelete('cascade'); 
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
        Schema::dropIfExists('penerbangan_promo');
    }
}
