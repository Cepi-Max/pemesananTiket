<?php

namespace Database\Seeders;

use App\Models\DashboardImage;
use App\Models\DownloadAbleFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DownloadFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DownloadAbleFile::create([
            'jadwal_penerbangan' => 'file1.pdf',
            'brosur_pariwisata' => 'file2.pdf',
            'syarat_ketentuan' => 'file3.pdf'
        ]);
    }
}
