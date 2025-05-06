<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_us')->insert([
            'profil' => 'Travelokan bertugas mengelola, menyimpan, mendokumentasikan, dan memberikan pelayanan tiket kepada manusia agar mempermudah dalam mendapatkan tiket dan mengetahui jadwal penerbangan.',
            'visi' => 'Terbentuknya manusia yang menghargai waktu.',
            'misi' => '1) mempermudah manusia dalam mendapat tiket pesawat.',
            'gambar_struktur_organisasi' => '1.png',
            'alamat' => 'Jl. Raya Desa Contoh No. 123, Kecamatan Contoh, Kabupaten Contoh, Provinsi Contoh',
            'kontak' => '0812-3456-7890 / email@desacontoh.id',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
