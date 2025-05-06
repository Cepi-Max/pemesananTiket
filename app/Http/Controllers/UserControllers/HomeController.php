<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\DashboardImage;
use App\Models\Gallery;
use App\Models\KelasPesawat;
use App\Models\Promo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $galleries = Gallery::all();
        $kelas_pesawat = KelasPesawat::all();
        $dashboardImages = DashboardImage::all();
        $promos = Promo::all();

        $data = [
            'title' => 'Home',
            'galleries' => $galleries,
            'classes' => $kelas_pesawat,
            'dashboardImages' => $dashboardImages,
            'promos' => $promos,
        ];

        // Mengirim data galeri dan gambar ke view 'homepage'
        return view('user-pages.homepage', $data);
    }

    function aboutUs()
    {
        $aboutUs = AboutUs::first();
        $data = [
            'title' => 'About SohibTravel',
            'aboutUs' => $aboutUs
        ];

        return view('user-pages.aboutUs', $data);
    }
}
