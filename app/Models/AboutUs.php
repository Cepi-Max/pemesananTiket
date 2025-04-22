<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    //
    protected $table = 'about_us';
    protected $fillable = ['profil', 'visi_misi', 'gambar_struktur_organisasi', 'alamat', 'kontak'];
}
