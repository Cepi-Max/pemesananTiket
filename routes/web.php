<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BandaraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailPenumpangController;
use App\Http\Controllers\DownloadAbleFileController;
use App\Http\Controllers\KelasPesawatController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\MaskapaiController;
use App\Http\Controllers\PenerbanganController;
use App\Http\Controllers\PesawatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UserControllers\DaftarPenerbanganController;
use App\Http\Controllers\UserControllers\HomeController;
use App\Http\Controllers\UserControllers\PesanTiketController;
use App\Http\Controllers\UserControllers\UserPemesananController;
use App\Http\Controllers\UserControllers\UserPenerbanganController;
use App\Http\Controllers\UserControllers\DaftarPenerbanganController;
use App\Models\Bandara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/welcome', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/home', [HomeController::class, 'home']);

// Route Pencarian penerbangan di user
Route::get('/penerbangan/search', [UserPenerbanganController::class, 'search'])->name('penerbangan.search');

// Pemesanan tiket
Route::get('/pemesanan/{slug}', [UserPemesananController::class, 'form'])->name('pemesanan.form');
Route::post('/pemesanan/submit', [UserPemesananController::class, 'submit'])->name('pemesanan.submit');
Route::get('daftar-penerbangan', [UserPemesananController::class, 'index'])->name('daftar.penerbangan');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Main Page
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/admin/banner-setting', [DashboardController::class, 'bannerSettingForm'])->name('banner.setting');
     // Web settings
     Route::get('/admin/setting', [DashboardController::class, 'bannerSettingForm'])->name('show.bannerSettingForm');
     Route::post('/admin/setting/save', [DashboardController::class, 'bannerSettingSave'])->name('bannerSettingSave');
     Route::post('/admin/setting/update/{id}', [DashboardController::class, 'bannerSettingUpdate'])->name('bannerSettingUpdate');
 
    // Artikel Admin 
    Route::get('/admin/info-list', [ArticleController::class, 'index'])->name('show.article');
    Route::get('/admin/info-form/{slug?}', [ArticleController::class, 'form'])->name('show.article.form');
    Route::post('/admin/info-save', [ArticleController::class, 'save'])->name('article.save');
    Route::post('/admin/info-update/{slug}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/admin/info-delete/{slug}', [ArticleController::class, 'delete'])->name('article.delete');
    // Articles Categories
    Route::post('/admin/info-categories/save', [ArticleCategoryController::class, 'save'])->name('article.category.save');
    Route::post('/admin/info-categories/update/{slug}', [ArticleCategoryController::class, 'update'])->name('article.category.update');
    Route::delete('/admin/info-categories/{slug}', [ArticleCategoryController::class, 'delete'])->name('article.category.delete');
    //Profile
    Route::get('/admin/about-us', [AboutUsController::class, 'index'])->name('show.profile');
    Route::get('/admin/about-us-form/{id?}', [AboutUsController::class, 'index'])->name('AboutUs.form');
    Route::put('/admin/about-us-update/{id}', [AboutUsController::class, 'update'])->name('AboutUs.update');
    // File bisa di download Admin 
    Route::get('/admin/file-form/{slug?}', [DownloadAbleFileController::class, 'index'])->name('show.downloadfile.form');
    Route::post('/admin/file-update/{slug}', [DownloadAbleFileController::class, 'update'])->name('downloadfile.update');
    Route::get('/admin/{fileDownload}/preview', [DownloadAbleFileController::class, 'previewFile'])->name('downloadfile.preview');
    Route::get('/admin/{fileDownload}/download', [DownloadAbleFileController::class, 'downloadFile'])->name('downloadfile.download');
    
    // Routing untuk operasi CRUD Kota
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kota', KotaController::class)->parameters([
            'kota' => 'slug'  // Gunakan 'slug' sebagai parameter dalam URL
        ]);
    });
    
    // Routing untuk operasi CRUD Kelas Pesawat
    Route::resource('/admin/kelas_pesawat', KelasPesawatController::class);
    Route::resource('/admin/bandara', BandaraController::class);
    // Routing untuk operasi CRUD Maskapai
    Route::resource('admin/maskapai', MaskapaiController::class);
    // Routing untuk operasi CRUD Promo
    Route::resource('/admin/promo', PromoController::class);
    // Routing untuk operasi CRUD Pesawat
    Route::resource('/admin/pesawat', PesawatController::class);
    // Routing untuk operasi CRUD Penerbangan
    Route::resource('/admin/penerbangan', PenerbanganController::class);
    // Routing untuk operasi CRUD Pesan Tiket
    Route::resource('/admin/pesan_tiket', PesanTiketController::class);
    // Routing untuk operasi CRUD Detail Penumpang dalam setiap pesanan tiket
    Route::resource('/admin/pesan_tiket/{pesanTiketId}/penumpang', DetailPenumpangController::class);

});

// Jangan dihapus, ini untuk ambil data bandara keperluan fitur search penerbangan
// web.php
Route::get('/bandara/autocomplete', [UserPenerbanganController::class, 'autocomplete'])->name('bandara.autocomplete');


require __DIR__ . '/auth.php';
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kota', KotaController::class);
});