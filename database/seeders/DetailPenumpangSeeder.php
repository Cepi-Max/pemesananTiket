<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailPenumpang;
use Illuminate\Support\Str;

class DetailPenumpangSeeder extends Seeder
{
    public function run()
    {
        // Data penumpang dummy
        $penumpangData = [
            [
                'order_slug' => 'order-123',
                'nama' => 'John Doe',
                'no_identitas' => '123456789',
                'alamat' => 'Jalan Merdeka No. 1, Jakarta',
            ],
            [
                'order_slug' => 'order-124',
                'nama' => 'Jane Smith',
                'no_identitas' => '987654321',
                'alamat' => 'Jalan Sudirman No. 2, Jakarta',
            ],
            [
                'order_slug' => 'order-125',
                'nama' => 'Michael Johnson',
                'no_identitas' => '112233445',
                'alamat' => 'Jalan Satria No. 3, Bandung',
            ],
        ];

        foreach ($penumpangData as $data) {
            DetailPenumpang::create([
                'order_slug' => $data['order_slug'],
                'nama' => $data['nama'],
                'no_identitas' => $data['no_identitas'],
                'alamat' => $data['alamat'],
            ]);
        }
    }
}
