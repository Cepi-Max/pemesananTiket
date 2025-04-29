<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\DashboardImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // Mengambil data galeri dari database
        $galleries = Gallery::all();

        // Mengambil data gambar dari tabel dashboard_image
        $dashboardImages = DashboardImage::all(); // Ambil gambar pertama (sesuaikan jika ada lebih dari satu)

        // Mengirim data galeri dan gambar ke view 'homepage'
        return view('user-pages.homepage', compact('galleries', 'dashboardImages'));
    }
}
