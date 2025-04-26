<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BandaraSeeder extends Seeder
{
    public function run(): void
    {
        // List bandara + nama kotanya
        $bandaraList = [
            ['nama_bandara' => 'Soekarno-Hatta International Airport', 'nama_kota' => 'Jakarta'],
            ['nama_bandara' => 'Ngurah Rai International Airport', 'nama_kota' => 'Denpasar'],
            ['nama_bandara' => 'Juanda International Airport', 'nama_kota' => 'Surabaya'],
            ['nama_bandara' => 'Sultan Hasanuddin International Airport', 'nama_kota' => 'Makassar'],
            ['nama_bandara' => 'Kualanamu International Airport', 'nama_kota' => 'Medan'],
            ['nama_bandara' => 'Minangkabau International Airport', 'nama_kota' => 'Padang'],
            ['nama_bandara' => 'Adisutjipto International Airport', 'nama_kota' => 'Yogyakarta'],
            ['nama_bandara' => 'Ahmad Yani International Airport', 'nama_kota' => 'Semarang'],
            ['nama_bandara' => 'Halim Perdanakusuma Airport', 'nama_kota' => 'Jakarta'],
            ['nama_bandara' => 'Sultan Mahmud Badaruddin II Airport', 'nama_kota' => 'Palembang'],
        ];

        foreach ($bandaraList as $item) {
            $kota = DB::table('kota')->where('nama_kota', $item['nama_kota'])->first();

            if ($kota) {
                DB::table('bandara')->insert([
                    'slug' => Str::slug($item['nama_bandara']) . '-' . Str::random(5),
                    'nama_bandara' => $item['nama_bandara'],
                    'id_kota' => $kota->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                echo "Kota '{$item['nama_kota']}' tidak ditemukan di tabel kota. Bandara '{$item['nama_bandara']}' tidak dibuat.\n";
            }
        }
    }
}
