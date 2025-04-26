<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesawat;
use Illuminate\Support\Str;

class PesawatSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     *
     * @return void
     */
    public function run(): void
    {
        // Pesawat untuk Garuda Indonesia
        Pesawat::create([
            'slug' => Str::slug('Garuda A330') . '-' . Str::random(5),
            'kode_pesawat' => 'A330',
            'id_maskapai' => 1, // ID Maskapai Garuda Indonesia
            'id_kelas' => 1,    // ID Kelas Ekonomi
            'jumlah_kursi' => 300,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Pesawat::create([
            'slug' => Str::slug('Garuda B777') . '-' . Str::random(5),
            'kode_pesawat' => 'B777',
            'id_maskapai' => 1, // ID Maskapai Garuda Indonesia
            'id_kelas' => 2,    // ID Kelas Bisnis
            'jumlah_kursi' => 350,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pesawat untuk Lion Air
        Pesawat::create([
            'slug' => Str::slug('Lion A320') . '-' . Str::random(5),
            'kode_pesawat' => 'A320',
            'id_maskapai' => 2, // ID Maskapai Lion Air
            'id_kelas' => 1,    // ID Kelas Ekonomi
            'jumlah_kursi' => 180,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Pesawat::create([
            'slug' => Str::slug('Lion B737') . '-' . Str::random(5),
            'kode_pesawat' => 'B737',
            'id_maskapai' => 2, // ID Maskapai Lion Air
            'id_kelas' => 2,    // ID Kelas Bisnis
            'jumlah_kursi' => 210,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pesawat untuk Citilink
        Pesawat::create([
            'slug' => Str::slug('Citilink A320') . '-' . Str::random(5),
            'kode_pesawat' => 'A320',
            'id_maskapai' => 3, // ID Maskapai Citilink
            'id_kelas' => 1,    // ID Kelas Ekonomi
            'jumlah_kursi' => 180,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Pesawat::create([
            'slug' => Str::slug('Citilink A330') . '-' . Str::random(5),
            'kode_pesawat' => 'A330',
            'id_maskapai' => 3, // ID Maskapai Citilink
            'id_kelas' => 2,    // ID Kelas Bisnis
            'jumlah_kursi' => 280,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pesawat untuk Batik Air
        Pesawat::create([
            'slug' => Str::slug('Batik A320') . '-' . Str::random(5),
            'kode_pesawat' => 'A320',
            'id_maskapai' => 4, // ID Maskapai Batik Air
            'id_kelas' => 1,    // ID Kelas Ekonomi
            'jumlah_kursi' => 200,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Pesawat::create([
            'slug' => Str::slug('Batik B737') . '-' . Str::random(5),
            'kode_pesawat' => 'B737',
            'id_maskapai' => 4, // ID Maskapai Batik Air
            'id_kelas' => 2,    // ID Kelas Bisnis
            'jumlah_kursi' => 230,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pesawat untuk Sriwijaya Air
        Pesawat::create([
            'slug' => Str::slug('Sriwijaya A320') . '-' . Str::random(5),
            'kode_pesawat' => 'A320',
            'id_maskapai' => 5, // ID Maskapai Sriwijaya Air
            'id_kelas' => 1,    // ID Kelas Ekonomi
            'jumlah_kursi' => 180,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Pesawat::create([
            'slug' => Str::slug('Sriwijaya B737') . '-' . Str::random(5),
            'kode_pesawat' => 'B737',
            'id_maskapai' => 5, // ID Maskapai Sriwijaya Air
            'id_kelas' => 2,    // ID Kelas Bisnis
            'jumlah_kursi' => 220,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
