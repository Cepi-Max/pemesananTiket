<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadAbleFile extends Model
{
    //
    protected $table = 'downloadable_file';
    protected $fillable = ['jadwal_penerbangan', 'brosur_pariwisata', 'syarat_ketentuan'];
}
