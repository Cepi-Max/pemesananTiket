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
            [
                'nama_kota' => 'Jakarta',
            ],
            [
                'nama_kota' => 'Denpasar',
            ],
            [
                'nama_kota' => 'Surabaya',
            ],
            [
                'nama_kota' => 'Makassar',
            ],
            [
                'nama_kota' => 'Medan',
            ],
            [
                'nama_kota' => 'Semarang',
            ],
            [
                'nama_kota' => 'Yogyakarta',
            ],
            [
                'nama_kota' => 'Padang',
            ],
            [
                'nama_kota' => 'Balikpapan',
            ],
            [
                'nama_kota' => 'Pangkalpinang',
            ],
        ];

        foreach ($kotaList as $kota) {
            DB::table('kota')->insert([
                'slug' => Str::slug($kota['nama_kota']) . '-' . Str::random(5),
                'nama_kota' => $kota['nama_kota'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
