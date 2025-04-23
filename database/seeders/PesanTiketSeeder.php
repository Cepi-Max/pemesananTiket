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
            'tanggal_berangkat' => '2025-05-01',
            'tanggal_tiba' => '2025-05-01',
            'jam_berangkat' => '10:00:00',
            'id_bandara_asal' => 1, // ID Bandara Soekarno-Hatta (misalnya)
            'id_bandara_tujuan' => 2, // ID Bandara Juanda Surabaya (misalnya)
            'id_pesawat' => 1, // ID Pesawat Garuda Indonesia A330
            'total_harga' => 3000000.00,
            'status' => 'Booked',
        ]);
    }
}
