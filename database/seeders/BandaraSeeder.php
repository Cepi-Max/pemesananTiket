<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BandaraSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil id kota dari tabel kota berdasarkan nama kota yang ada
        $kotaId = DB::table('kota')->where('nama_kota', 'Jakarta')->first()->id; // Misalnya kita cari kota Jakarta

        $bandara = [
            [
                'nama_bandara' => 'Soekarno-Hatta International Airport',
                'id_kota' => $kotaId,
            ],
            [
                'nama_bandara' => 'Ngurah Rai International Airport',
                'id_kota' => $kotaId,  // Kota ini juga Jakarta
            ],
            [
                'nama_bandara' => 'Juanda International Airport',
                'id_kota' => $kotaId,
            ],
            [
                'nama_bandara' => 'Sultan Hasanuddin International Airport',
                'id_kota' => $kotaId,
            ],
        ];

        foreach ($bandara as $item) {
            DB::table('bandara')->insert([
                'slug' => Str::slug($item['nama_bandara']) . '-' . Str::random(5),
                'nama_bandara' => $item['nama_bandara'],
                'id_kota' => $item['id_kota'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
