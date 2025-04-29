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
                'latitude' => -6.208763,
                'longitude' => 106.845599,
            ],
            [
                'nama_kota' => 'Denpasar',
                'latitude' => -8.670458,
                'longitude' => 115.212629,
            ],
            [
                'nama_kota' => 'Surabaya',
                'latitude' => -7.257472,
                'longitude' => 112.752088,
            ],
            [
                'nama_kota' => 'Makassar',
                'latitude' => -5.147665,
                'longitude' => 119.432732,
            ],
            [
                'nama_kota' => 'Medan',
                'latitude' => 3.595196,
                'longitude' => 98.672223,
            ],
            [
                'nama_kota' => 'Semarang',
                'latitude' => -6.966667,
                'longitude' => 110.416664,
            ],
            [
                'nama_kota' => 'Yogyakarta',
                'latitude' => -7.797068,
                'longitude' => 110.370529,
            ],
            [
                'nama_kota' => 'Padang',
                'latitude' => -0.947083,
                'longitude' => 100.417181,
            ],
            [
                'nama_kota' => 'Balikpapan',
                'latitude' => -1.265386,
                'longitude' => 116.831200,
            ],
            [
                'nama_kota' => 'Pangkalpinang',
                'latitude' => -2.1314,
                'longitude' => 106.1090,
            ],
        ];

        foreach ($kotaList as $kota) {
            DB::table('kota')->insert([
                'slug' => Str::slug($kota['nama_kota']) . '-' . Str::random(5),
                'nama_kota' => $kota['nama_kota'],
                'latitude' => $kota['latitude'],
                'longitude' => $kota['longitude'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
