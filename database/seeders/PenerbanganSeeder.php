<?php

namespace Database\Seeders;

use App\Models\Penerbangan;
use App\Models\Bandara;
use App\Models\Pesawat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PenerbanganSeeder extends Seeder
{
    public function run(): void
    {
        $bandaraIds = Bandara::pluck('id')->toArray();
        $pesawatIds = Pesawat::pluck('id')->toArray();

        if (count($bandaraIds) < 2 || count($pesawatIds) < 1) {
            $this->command->warn('Seeder gagal: Minimal harus ada 2 bandara dan 1 pesawat.');
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            // Pilih asal dan tujuan berbeda
            do {
                $asal = fake()->randomElement($bandaraIds);
                $tujuan = fake()->randomElement($bandaraIds);
            } while ($asal === $tujuan);

            $tanggalBerangkat = fake()->dateTimeBetween('+1 days', '+30 days');
            $tanggalTiba = (clone $tanggalBerangkat)->modify('+2 hours');

            $slug = Str::slug('penerbangan-' . $i . '-' . Str::random(5));

            Penerbangan::create([
                'slug' => $slug,
                'tanggal_berangkat' => $tanggalBerangkat->format('Y-m-d'),
                'tanggal_tiba' => $tanggalTiba->format('Y-m-d'),
                'jam_berangkat' => $tanggalBerangkat->format('H:i:s'),
                'id_bandara_asal' => $asal,
                'id_bandara_tujuan' => $tujuan,
                'id_pesawat' => fake()->randomElement($pesawatIds),
                'maks_penumpang' => fake()->numberBetween(100, 300),
                'harga_dewasa' => fake()->randomFloat(2, 500000, 2000000),
                'harga_anak' => fake()->randomFloat(2, 300000, 1500000),
            ]);
        }
    }
}
