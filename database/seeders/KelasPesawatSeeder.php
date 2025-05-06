<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KelasPesawatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            'Ekonomi',
            'Bisnis',
            'First Class',
            'Premium Ekonomi',
        ];

        foreach ($kelas as $nama) {
            DB::table('kelas_pesawat')->insert([
                'slug' => Str::slug($nama),
                'nama_kelas' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
