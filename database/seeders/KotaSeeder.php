<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KotaSeeder extends Seeder
{
    public function run(): void
    {
        $kotaList = [
            'Jakarta',
            'Denpasar',
            'Surabaya',
            'Makassar',
            'Medan',
            'Yogyakarta',
            'Padang',
            'Semarang',
            'Palembang',
            'Bandung'
        ];

        foreach ($kotaList as $namaKota) {
            DB::table('kota')->insert([
                'slug' => Str::slug($namaKota) . '-' . Str::random(5),
                'nama_kota' => $namaKota,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
