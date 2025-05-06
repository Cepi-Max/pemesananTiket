<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Gallery;
use App\Models\DashboardImage;
use App\Models\KelasPesawat;
use Illuminate\Http\Request;
use App\Models\Promo;

class HomeController extends Controller
{
    public function home()
    {
        $galleries = Gallery::all();
        $kelas_pesawat = KelasPesawat::all();
        $dashboardImages = DashboardImage::all();
        $promos = Promo::all(); // Tambahkan ini untuk ambil semua promo

        $data = [
            'title' => 'Home',
            'galleries' => $galleries,
            'classes' => $kelas_pesawat,
            'dashboardImages' => $dashboardImages,
            'promos' => $promos, // Kirim ke view
        ];

        return view('user-pages.homepage', $data);
    }
}
