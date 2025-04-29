<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penerbangan;
use Illuminate\Support\Str;

class PenerbanganSeeder extends Seeder
{
    public function run()
    {
        // Data penerbangan dummy
        $penerbanganData = [
            [
                'kode_penerbangan' => 'GA101',
                'nama_penerbangan' => 'Garuda Indonesia Jakarta - Bali',
                'asal' => 'Jakarta',
                'tujuan' => 'Bali',
                'jadwal_berangkat' => '2025-06-01 09:00:00',
                'jadwal_tiba' => '2025-06-01 10:30:00',
            ],
            [
                'kode_penerbangan' => 'JT202',
                'nama_penerbangan' => 'Lion Air Surabaya - Makassar',
                'asal' => 'Surabaya',
                'tujuan' => 'Makassar',
                'jadwal_berangkat' => '2025-06-02 15:00:00',
                'jadwal_tiba' => '2025-06-02 17:30:00',
            ],
            [
                'kode_penerbangan' => 'SJ303',
                'nama_penerbangan' => 'Sriwijaya Air Medan - Jakarta',
                'asal' => 'Medan',
                'tujuan' => 'Jakarta',
                'jadwal_berangkat' => '2025-06-03 18:00:00',
                'jadwal_tiba' => '2025-06-03 19:30:00',
            ],
        ];

        foreach ($penerbanganData as $data) {
            // Membuat slug
            $slug = Str::slug($data['nama_penerbangan']);
            $existingSlugCount = Penerbangan::where('slug', 'LIKE', "{$slug}%")->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }

            Penerbangan::create([
                'slug' => $slug,
                'kode_penerbangan' => $data['kode_penerbangan'],
                'nama_penerbangan' => $data['nama_penerbangan'],
                'asal' => $data['asal'],
                'tujuan' => $data['tujuan'],
                'jadwal_berangkat' => $data['jadwal_berangkat'],
                'jadwal_tiba' => $data['jadwal_tiba'],
            ]);
        }
    }
}
