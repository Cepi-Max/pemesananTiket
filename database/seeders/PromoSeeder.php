<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;
use Illuminate\Support\Str;

class PromoSeeder extends Seeder
{
    public function run()
    {
        // Data promo dummy
        $promoData = [
            [
                'kode_promo' => 'PROMO1',
                'diskon' => 10,
                'deskripsi' => 'Diskon 10% untuk pembelian pertama',
            ],
            [
                'kode_promo' => 'PROMO2',
                'diskon' => 20,
                'deskripsi' => 'Diskon 20% untuk produk tertentu',
            ],
            [
                'kode_promo' => 'PROMO3',
                'diskon' => 30,
                'deskripsi' => 'Diskon 30% untuk pembelian lebih dari 3 produk',
            ],
        ];

        foreach ($promoData as $data) {
            // Membuat slug
            $slug = Str::slug($data['kode_promo']);
            $existingSlugCount = Promo::where('slug', 'LIKE', "{$slug}%")->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }

            Promo::create([
                'slug' => $slug,
                'kode_promo' => $data['kode_promo'],
                'diskon' => $data['diskon'],
                'deskripsi' => $data['deskripsi'],
            ]);
        }
    }
}
