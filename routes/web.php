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
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('show.about_us');

// Route Pencarian penerbangan di user
Route::get('/penerbangan/search', [UserPenerbanganController::class, 'search'])->name('penerbangan.search');

// Pake Promo
Route::post('/cek-promo', [PromoController::class, 'cekPromo'])->name('cek.promo');
// Promo Tiket
Route::get('/promo', [PromoController::class, 'dashboard'])->name('promo');
Route::get('/promo/{slug}', [PromoController::class, 'show'])->name('promo.detail');

// Pemesanan tiket
Route::get('/pemesanan/{slug}', [UserPemesananController::class, 'form'])->name('pemesanan.form');
Route::post('/pemesanan/submit', [UserPemesananController::class, 'submit'])->name('pemesanan.submit');
Route::get('daftar-penerbangan', [UserPemesananController::class, 'index'])->name('daftar.penerbangan');
// Bayar
Route::post('/bayar', [UserPemesananController::class, 'bayar'])->name('bayar');
Route::get('/tiket/{kodeBooking}', [UserPemesananController::class, 'tiket'])->name('tiket.jadi');
// Download Pdf
Route::post('/download-tiket', [PesanTiketController::class, 'downloadTiket'])->name('download.tiket');

//Profile SohibTravel
Route::get('/admin/about-us', [AboutUsController::class, 'index'])->name('show.profile');
Route::get('/admin/about-us-form/{id?}', [AboutUsController::class, 'index'])->name('AboutUs.form');
Route::put('/admin/about-us-update/{id}', [AboutUsController::class, 'update'])->name('AboutUs.update');


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
    Route::post('/admin/about-us-update/{id}', [AboutUsController::class, 'update'])->name('AboutUs.update');
    // File bisa di download Admin 
    Route::get('/admin/file-form/{slug?}', [DownloadAbleFileController::class, 'index'])->name('show.downloadfile.form');
    Route::post('/admin/file-update/{slug}', [DownloadAbleFileController::class, 'update'])->name('downloadfile.update');
    Route::get('/admin/{fileDownload}/preview', [DownloadAbleFileController::class, 'previewFile'])->name('downloadfile.preview');
    Route::get('/admin/{fileDownload}/download', [DownloadAbleFileController::class, 'downloadFile'])->name('downloadfile.download');
    
    // // Routing untuk operasi CRUD Kota
    // Route::prefix('admin')->name('admin.')->group(function () {
    //     Route::resource('kota', KotaController::class)->parameters([
    //         'kota' => 'slug' 
    //     ]);
    // });
    
    // Routing untuk operasi CRUD Kota
    Route::get('/admin/kota/', [KotaController::class, 'index'])->name('admin.kota.index');
    Route::get('/admin/kota/create', [KotaController::class, 'create'])->name('admin.kota.create');
    Route::get('/admin/kota/edit/{slug}', [KotaController::class, 'edit'])->name('admin.kota.edit');
    Route::post('/admin/kota/save', [KotaController::class, 'store'])->name('admin.kota.store');
    Route::post('/admin/kota/update/{slug}', [KotaController::class, 'update'])->name('admin.kota.update');
    Route::delete('/admin/kota/delete/{slug}', [KotaController::class, 'destroy'])->name('admin.kota.destroy');
    
    // Routing untuk operasi CRUD Kelas Pesawat
    Route::get('/admin/kelas_pesawat/', [KelasPesawatController::class, 'index'])->name('admin.kelas_pesawat.index');
    Route::get('/admin/kelas_pesawat/create', [KelasPesawatController::class, 'create'])->name('admin.kelas_pesawat.create');
    Route::get('/admin/kelas_pesawat/edit/{slug}', [KelasPesawatController::class, 'edit'])->name('admin.kelas_pesawat.edit');
    Route::post('/admin/kelas_pesawat/save', [KelasPesawatController::class, 'store'])->name('admin.kelas_pesawat.store');
    Route::put('/admin/kelas_pesawat/update/{slug}', [KelasPesawatController::class, 'update'])->name('admin.kelas_pesawat.update');
    Route::delete('/admin/kelas_pesawat/delete/{slug}', [KelasPesawatController::class, 'destroy'])->name('admin.kelas_pesawat.destroy');

    // Routing untuk operasi CRUD Bandara
    Route::get('/admin/bandara/', [BandaraController::class, 'index'])->name('admin.bandara.index');
    Route::get('/admin/bandara/create', [BandaraController::class, 'create'])->name('admin.bandara.create');
    Route::get('/admin/bandara/edit/{slug}', [BandaraController::class, 'edit'])->name('admin.bandara.edit');
    Route::post('/admin/bandara/save', [BandaraController::class, 'store'])->name('admin.bandara.store');
    Route::post('/admin/bandara/update/{slug}', [BandaraController::class, 'update'])->name('admin.bandara.update');
    Route::delete('/admin/bandara/delete/{slug}', [BandaraController::class, 'destroy'])->name('admin.bandara.destroy');

    // Routing untuk operasi CRUD Maskapai
    Route::get('/admin/maskapai/', [MaskapaiController::class, 'index'])->name('admin.maskapai.index');
    Route::get('/admin/maskapai/create', [MaskapaiController::class, 'create'])->name('admin.maskapai.create');
    Route::get('/admin/maskapai/edit/{slug}', [MaskapaiController::class, 'edit'])->name('admin.maskapai.edit');
    Route::post('/admin/maskapai/save', [MaskapaiController::class, 'store'])->name('admin.maskapai.store');
    Route::put('/admin/maskapai/update/{slug}', [MaskapaiController::class, 'update'])->name('admin.maskapai.update');
    Route::delete('/admin/maskapai/delete/{slug}', [MaskapaiController::class, 'destroy'])->name('admin.maskapai.destroy');
    
    // Routing untuk operasi CRUD Promo
    Route::get('/admin/promo/', [PromoController::class, 'index'])->name('admin.promo.index');
    Route::get('/admin/promo/create', [PromoController::class, 'create'])->name('admin.promo.create');
    Route::get('/admin/promo/edit/{slug}', [PromoController::class, 'edit'])->name('admin.promo.edit');
    Route::post('/admin/promo/save', [PromoController::class, 'store'])->name('admin.promo.store');
    Route::post('/admin/promo/update/{slug}', [PromoController::class, 'update'])->name('admin.promo.update');
    Route::delete('/admin/promo/delete/{slug}', [PromoController::class, 'destroy'])->name('admin.promo.destroy');
    
    // Routing untuk operasi CRUD Pesawat
    Route::resource('/admin/pesawat', PesawatController::class);
    
    // Routing untuk operasi CRUD Penerbangan
    Route::get('/admin/penerbangan/', [PenerbanganController::class, 'index'])->name('admin.penerbangan.index');
    Route::get('/admin/penerbangan/create', [PenerbanganController::class, 'create'])->name('admin.penerbangan.create');
    Route::get('/admin/penerbangan/edit/{slug}', [PenerbanganController::class, 'edit'])->name('admin.penerbangan.edit');
    Route::post('/admin/penerbangan/save', [PenerbanganController::class, 'store'])->name('admin.penerbangan.store');
    Route::post('/admin/penerbangan/update/{slug}', [PenerbanganController::class, 'update'])->name('admin.penerbangan.update');
    Route::delete('/admin/penerbangan/delete/{slug}', [PenerbanganController::class, 'destroy'])->name('admin.penerbangan.destroy');
    
    // Routing untuk operasi CRUD Pesan Tiket
    Route::resource('/admin/pesan_tiket', PesanTiketController::class);
    // Routing untuk operasi CRUD Detail Penumpang dalam setiap pesanan tiket
    Route::resource('/admin/pesan_tiket/{pesanTiketId}/penumpang', DetailPenumpangController::class);

});

// Jangan dihapus, ini untuk ambil data bandara keperluan fitur search penerbangan
// web.php
Route::get('/bandara/autocomplete', [UserPenerbanganController::class, 'autocomplete'])->name('bandara.autocomplete');


require __DIR__ . '/auth.php';