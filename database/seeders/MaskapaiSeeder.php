<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maskapai;
use Illuminate\Support\Str;

class MaskapaiSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     *
     * @return void
     */
    public function run(): void
    {
        $maskapaiList = [
            [
                'nama_maskapai' => 'Garuda Indonesia',
                'logo' => 'garuda.jpg',
            ],
            [
                'nama_maskapai' => 'Lion Air',
                'logo' => 'lion.jpg',
            ],
            [
                'nama_maskapai' => 'Citilink',
                'logo' => 'citilink.jpg',
            ],
            [
                'nama_maskapai' => 'Batik Air',
                'logo' => 'batik.jpg',
            ],
            [
                'nama_maskapai' => 'Sriwijaya Air',
                'logo' => 'sriwijaya.jpg',
            ],
        ];

        foreach ($maskapaiList as $maskapai) {
            Maskapai::create([
                'slug' => Str::slug($maskapai['nama_maskapai']) . '-' . Str::random(5),
                'nama_maskapai' => $maskapai['nama_maskapai'],
                'logo' => $maskapai['logo'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
