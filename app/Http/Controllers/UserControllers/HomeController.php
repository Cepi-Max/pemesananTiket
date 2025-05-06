<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\DashboardImage;
use App\Models\KelasPesawat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $galleries = Gallery::all();
        $kelas_pesawat = KelasPesawat::all();        
        $dashboardImages = DashboardImage::all(); 

        $data = [
            'title' => 'Home',
            'galleries' => $galleries,
            'classes' => $kelas_pesawat,
            'dashboardImages' => $dashboardImages,
        ];

        // Mengirim data galeri dan gambar ke view 'homepage'
        return view('user-pages.homepage', $data);
    }
}
