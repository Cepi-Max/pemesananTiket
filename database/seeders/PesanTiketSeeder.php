<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PesanTiket;
use Illuminate\Support\Str;

class PesanTiketSeeder extends Seeder
{
    public function run()
    {
        // Data pesanan tiket dummy
        $pesanTiketData = [
            [
                'kode_pesanan' => 'PT001',
                'nama_pemesan' => 'John Doe',
                'jumlah_tiket' => 2,
                'jadwal_penerbangan' => '2025-06-01 09:00:00',
                'total_harga' => 500000,
            ],
            [
                'kode_pesanan' => 'PT002',
                'nama_pemesan' => 'Jane Smith',
                'jumlah_tiket' => 1,
                'jadwal_penerbangan' => '2025-06-02 15:00:00',
                'total_harga' => 250000,
            ],
            [
                'kode_pesanan' => 'PT003',
                'nama_pemesan' => 'Michael Johnson',
                'jumlah_tiket' => 3,
                'jadwal_penerbangan' => '2025-06-03 12:00:00',
                'total_harga' => 750000,
            ],
        ];

        foreach ($pesanTiketData as $data) {
            // Membuat slug
            $slug = Str::slug($data['kode_pesanan']);
            $existingSlugCount = PesanTiket::where('slug', 'LIKE', "{$slug}%")->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }

            PesanTiket::create([
                'slug' => $slug,
                'kode_pesanan' => $data['kode_pesanan'],
                'nama_pemesan' => $data['nama_pemesan'],
                'jumlah_tiket' => $data['jumlah_tiket'],
                'jadwal_penerbangan' => $data['jadwal_penerbangan'],
                'total_harga' => $data['total_harga'],
            ]);
        }
    }
}
