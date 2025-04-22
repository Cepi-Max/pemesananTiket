<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\DownloadAbleFileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
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
<<<<<<< HEAD

    //Profile
    Route::get('/admin/about-us', [AboutUsController::class, 'index'])->name('show.profile');
    Route::get('/admin/about-us-form/{id?}', [AboutUsController::class, 'index'])->name('AboutUs.form');
    Route::put('/admin/about-us-update/{id}', [AboutUsController::class, 'update'])->name('AboutUs.update');
=======
    // File bisa di download Admin 
    Route::get('/admin/file-form/{slug?}', [DownloadAbleFileController::class, 'index'])->name('show.downloadfile.form');
    Route::post('/admin/file-update/{slug}', [DownloadAbleFileController::class, 'update'])->name('downloadfile.update');
    Route::get('/admin/{fileDownload}/preview', [DownloadAbleFileController::class, 'previewFile'])->name('downloadfile.preview');
    Route::get('/admin/{fileDownload}/download', [DownloadAbleFileController::class, 'downloadFile'])->name('downloadfile.download');
>>>>>>> 8fef1e08926ac19cd9a73044bf213cd95ac820a1
});

require __DIR__.'/auth.php';
