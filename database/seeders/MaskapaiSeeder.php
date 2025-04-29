<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maskapai;

class MaskapaiSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     *
     * @return void
     */
    public function run()
    {
        Maskapai::create([
            'slug' => 'garuda-indonesia',
            'nama_maskapai' => 'Garuda Indonesia',
            'logo' => 'garuda.png',
        ]);

        Maskapai::create([
            'slug' => 'lion-air',
            'nama_maskapai' => 'Lion Air',
            'logo' => 'Lion.png',
        ]);
    }
}
