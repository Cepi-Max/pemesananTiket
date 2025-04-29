<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BandaraSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar bandara dan kota yang sesuai
        $bandara = [
            ['nama_bandara' => 'Soekarno-Hatta International Airport', 'nama_kota' => 'Jakarta'],
            ['nama_bandara' => 'Halim Perdanakusuma International Airport', 'nama_kota' => 'Jakarta'],
            ['nama_bandara' => 'Ngurah Rai International Airport', 'nama_kota' => 'Denpasar'],
            ['nama_bandara' => 'Juanda International Airport', 'nama_kota' => 'Surabaya'],
            ['nama_bandara' => 'Sultan Hasanuddin International Airport', 'nama_kota' => 'Makassar'],
            ['nama_bandara' => 'Andi Djemma International Airport', 'nama_kota' => 'Makassar'],
            ['nama_bandara' => 'Sorowako International Airport', 'nama_kota' => 'Makassar'],
            ['nama_bandara' => 'Kualanamu International Airport', 'nama_kota' => 'Medan'],
            ['nama_bandara' => 'Aek Godang International Airport', 'nama_kota' => 'Medan'],
            ['nama_bandara' => 'Ahmad Yani International Airport', 'nama_kota' => 'Semarang'],
            ['nama_bandara' => 'Adisutjipto International Airport', 'nama_kota' => 'Yogyakarta'],
            ['nama_bandara' => 'Minangkabau International Airport', 'nama_kota' => 'Padang'],
            ['nama_bandara' => 'Sultan Aji Muhammad Sulaiman Airport', 'nama_kota' => 'Balikpapan'],
            ['nama_bandara' => 'Depati Amir Airport', 'nama_kota' => 'Pangkalpinang'],
        ];

        foreach ($bandara as $item) {
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
                echo "Kota '{$item['nama_kota']}' tidak ditemukan. Pastikan kota ini ada di tabel kota.\n";
            }
        }
    }
}
