<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesawat;
use App\Models\Maskapai;
use App\Models\KelasPesawat;
use Illuminate\Support\Str;

class PesawatSeeder extends Seeder
{
    public function run()
    {
        // Ambil maskapai dan kelas pesawat yang sudah ada
        $maskapai = Maskapai::all();
        $kelasPesawat = KelasPesawat::all();

        if ($maskapai->isEmpty() || $kelasPesawat->isEmpty()) {
            echo "Pastikan ada data di tabel maskapai dan kelas_pesawat terlebih dahulu.\n";
            return;
        }

        // Data pesawat dummy
        $pesawatData = [
            [
                'kode_pesawat' => 'GA123',
                'id_maskapai' => $maskapai->first()->id, // Asumsi menggunakan maskapai pertama
                'id_kelas' => $kelasPesawat->first()->id, // Asumsi menggunakan kelas pesawat pertama
                'jumlah_kursi' => 180,
            ],
            [
                'kode_pesawat' => 'JT456',
                'id_maskapai' => $maskapai->skip(1)->first()->id, // Maskapai kedua
                'id_kelas' => $kelasPesawat->skip(1)->first()->id, // Kelas pesawat kedua
                'jumlah_kursi' => 220,
            ],
            [
                'kode_pesawat' => 'SJ789',
                'id_maskapai' => $maskapai->skip(2)->first()->id, // Maskapai ketiga
                'id_kelas' => $kelasPesawat->skip(2)->first()->id, // Kelas pesawat ketiga
                'jumlah_kursi' => 200,
            ]
        ];

        // Menyimpan data pesawat ke database
        foreach ($pesawatData as $data) {
            // Membuat slug
            $slug = Str::slug($data['kode_pesawat']);
            $existingSlugCount = Pesawat::where('slug', 'LIKE', "{$slug}%")->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }

            Pesawat::create([
                'slug' => $slug,
                'kode_pesawat' => $data['kode_pesawat'],
                'id_maskapai' => $data['id_maskapai'],
                'id_kelas' => $data['id_kelas'],
                'jumlah_kursi' => $data['jumlah_kursi'],
            ]);
        }
    }
}
