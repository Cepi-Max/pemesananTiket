<?php

namespace Database\Seeders;

use App\Models\Penerbangan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PenerbanganSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Misal, id_bandara 1-10 dan id_pesawat 1-5 sudah ada di database
        for ($i = 0; $i < 20; $i++) {
            $tanggalBerangkat = $faker->dateTimeBetween('+1 days', '+1 month');
            $tanggalTiba = (clone $tanggalBerangkat)->modify('+'.rand(1,3).' hours'); // penerbangan 1-3 jam

            $idBandaraAsal = rand(1, 10);
            $idBandaraTujuan = rand(1, 10);
            while ($idBandaraTujuan == $idBandaraAsal) {
                $idBandaraTujuan = rand(1, 10); // Biar asal & tujuan gak sama
            }

            Penerbangan::create([
                'slug' => Str::slug($faker->word()) . '-' . Str::random(5),
                'tanggal_berangkat' => $tanggalBerangkat->format('Y-m-d'),
                'tanggal_tiba' => $tanggalTiba->format('Y-m-d'),
                'jam_berangkat' => $tanggalBerangkat->format('H:i:s'),
                'id_bandara_asal' => $idBandaraAsal,
                'id_bandara_tujuan' => $idBandaraTujuan,
                'id_pesawat' => rand(1, 5),
                'maks_penumpang' => rand(100, 300),
                'harga_dewasa' => $faker->randomFloat(2, 500000, 3000000),
                'harga_anak' => $faker->randomFloat(2, 250000, 2000000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
