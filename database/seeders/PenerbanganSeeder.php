<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penerbangan;

class PenerbanganSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     *
     * @return void
     */
    public function run()
    {
        Penerbangan::create([
            'slug' => 'garuda-jkt-sby',
            'tanggal_berangkat' => '2025-05-01',
            'tanggal_tiba' => '2025-05-01',
            'jam_berangkat' => '10:00:00',
            'id_bandara_asal' => 1, // ID Bandara Soekarno-Hatta (misalnya)
            'id_bandara_tujuan' => 2, // ID Bandara Juanda Surabaya (misalnya)
            'id_pesawat' => 1, // ID Pesawat Garuda Indonesia A330
            'maks_penumpang' => 300,
            'harga_dewasa' => 1500000.00,
            'harga_anak' => 800000.00,
        ]);
    }
}
