<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailPenumpang;

class DetailPenumpangSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     *
     * @return void
     */
    public function run()
    {
        DetailPenumpang::create([
            'id_pemesanan_tiket' => 1, // ID Pemesanan Tiket
            'nama_penumpang' => 'John Doe',
            'jenis_kelamin' => 'L', // Laki-laki
            'tipe_penumpang' => 'dewasa',
        ]);

        DetailPenumpang::create([
            'id_pemesanan_tiket' => 1, // ID Pemesanan Tiket
            'nama_penumpang' => 'Jane Doe',
            'jenis_kelamin' => 'P', // Perempuan
            'tipe_penumpang' => 'anak-anak',
        ]);
    }
}
