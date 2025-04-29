<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PesanTiket;

class PesanTiketSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     *
     * @return void
     */
    public function run()
    {
        PesanTiket::create([
            'kode_booking' => 'BOOK123',
            'id_orderer' => 1, // ID User yang memesan
            'id_penerbangan' => 1, // ID Penerbangan
            'total_harga' => 3000000.00,
            'status' => 'Booked',
        ]);
    }
}
