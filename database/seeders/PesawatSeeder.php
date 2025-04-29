<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesawat;
use Illuminate\Support\Str;

class PesawatSeeder extends Seeder
{
    public function run()
    {
        // Data pesawat dummy
        $pesawatData = [
            [
                'kode_pesawat' => 'GA123',
                'nama_pesawat' => 'Garuda Indonesia A330',
                'kapasitas' => 300,
                'deskripsi' => 'Pesawat Garuda Indonesia tipe A330 dengan kapasitas 300 penumpang.',
            ],
            [
                'kode_pesawat' => 'JT456',
                'nama_pesawat' => 'Lion Air Boeing 737',
                'kapasitas' => 200,
                'deskripsi' => 'Pesawat Lion Air tipe Boeing 737 dengan kapasitas 200 penumpang.',
            ],
            [
                'kode_pesawat' => 'SJ789',
                'nama_pesawat' => 'Sriwijaya Air Boeing 737-800',
                'kapasitas' => 180,
                'deskripsi' => 'Pesawat Sriwijaya Air tipe Boeing 737-800 dengan kapasitas 180 penumpang.',
            ],
        ];

        foreach ($pesawatData as $data) {
            // Membuat slug
            $slug = Str::slug($data['nama_pesawat']);
            $existingSlugCount = Pesawat::where('slug', 'LIKE', "{$slug}%")->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }

            Pesawat::create([
                'slug' => $slug,
                'kode_pesawat' => $data['kode_pesawat'],
                'nama_pesawat' => $data['nama_pesawat'],
                'kapasitas' => $data['kapasitas'],
                'deskripsi' => $data['deskripsi'],
            ]);
        }
    }
}
