<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesan_tiket_id')->constrained('pesan_tiket')->onDelete('cascade'); // Relasi ke pesan_tiket
            $table->string('payment_method');
            $table->decimal('amount', 15, 2); // Jumlah pembayaran
            $table->string('payment_status')->default('pending'); // Status pembayaran (default: pending)
            $table->timestamp('paid_at')->nullable(); // Waktu pembayaran
            $table->string('payment_proof')->nullable(); // Bukti pembayaran (opsional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
