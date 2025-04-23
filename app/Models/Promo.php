<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    // Tentukan nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'promo';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'slug', 
        'kode_promo', 
        'jumlah_%', 
        'jumlah_rp',
    ];

    // Tentukan kolom yang tidak boleh diisi
    protected $guarded = [];
}
