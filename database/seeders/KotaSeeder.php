<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kota;
use Illuminate\Support\Str;

class KotaSeeder extends Seeder
{
    public function run()
    {
        // Contoh data kota
        $kotaData = [
            [
                'nama_kota' => 'Jakarta',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
            ],
            [
                'nama_kota' => 'Surabaya',
                'latitude' => -7.2504,
                'longitude' => 112.7688,
            ],
            [
                'nama_kota' => 'Bandung',
                'latitude' => -6.9175,
                'longitude' => 107.6191,
            ],
            // Tambahkan data kota lainnya di sini
        ];

        foreach ($kotaData as $data) {
            $slug = Str::slug($data['nama_kota']);
            $existingSlugCount = Kota::where('slug', 'LIKE', "{$slug}%")->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }

            // Insert data kota ke database
            Kota::create([
                'slug' => $slug,
                'nama_kota' => $data['nama_kota'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
            ]);
        }
    }
}
