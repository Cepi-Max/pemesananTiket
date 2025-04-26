<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesawat;

class PesawatSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     *
     * @return void
     */
    public function run()
    {
        Pesawat::create([
            'slug' => 'garuda-a330',
            'kode_pesawat' => 'A330',
            'id_maskapai' => 1, // ID Maskapai Garuda Indonesia
            'id_kelas' => 1,    // ID Kelas Ekonomi (misalnya)
            'jumlah_kursi' => 300,
        ]);

        Pesawat::create([
            'slug' => 'lion-b737',
            'kode_pesawat' => 'B737',
            'id_maskapai' => 2, // ID Maskapai Lion Air
            'id_kelas' => 2,    // ID Kelas Bisnis (misalnya)
            'jumlah_kursi' => 200,
        ]);
    }
}
