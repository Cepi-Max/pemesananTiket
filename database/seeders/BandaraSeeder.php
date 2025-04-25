<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BandaraSeeder extends Seeder
{
    public function run(): void
    {
        $bandara = [
            [
                'nama_bandara' => 'Soekarno-Hatta International Airport',
                'latitude' => -6.1255560,
                'longitude' => 106.6558330,
            ],
            [
                'nama_bandara' => 'Ngurah Rai International Airport',
                'latitude' => -8.7481690,
                'longitude' => 115.1673430,
            ],
            [
                'nama_bandara' => 'Juanda International Airport',
                'latitude' => -7.3798030,
                'longitude' => 112.7875600,
            ],
            [
                'nama_bandara' => 'Sultan Hasanuddin International Airport',
                'latitude' => -5.0615900,
                'longitude' => 119.5539300,
            ],
        ];

        foreach ($bandara as $item) {
            DB::table('bandara')->insert([
                'slug' => Str::slug($item['nama_bandara']) . '-' . Str::random(5),
                'nama_bandara' => $item['nama_bandara'],
                'latitude' => $item['latitude'],
                'longitude' => $item['longitude'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
