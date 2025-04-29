<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maskapai;
use Illuminate\Support\Str;

class MaskapaiSeeder extends Seeder
{
    public function run()
    {
        // Data maskapai dummy
        $maskapaiData = [
            [
                'nama_maskapai' => 'Garuda Indonesia',
                'logo' => 'garuda.jpg',
            ],
            [
                'nama_maskapai' => 'Lion Air',
                'logo' => 'lion_air.jpg',
            ],
            [
                'nama_maskapai' => 'Sriwijaya Air',
                'logo' => 'sriwijaya_air.jpg',
            ],
        ];

        foreach ($maskapaiData as $data) {
            // Membuat slug
            $slug = Str::slug($data['nama_maskapai']);
            $existingSlugCount = Maskapai::where('slug', 'LIKE', "{$slug}%")->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }

            Maskapai::create([
                'slug' => $slug,
                'nama_maskapai' => $data['nama_maskapai'],
                'logo' => $data['logo'],
            ]);
        }
    }
}
