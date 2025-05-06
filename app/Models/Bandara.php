<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bandara extends Model
{
    use HasFactory;

    // Tentukan nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'bandara';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'slug', 
        'nama_bandara', 
        'id_kota'
    ];

    // Tentukan kolom yang tidak boleh diisi
    protected $guarded = [];

     // Relasi hasMany ke Penerbangan (asal)
     public function penerbanganAsal()
     {
         return $this->hasMany(Penerbangan::class, 'id_bandara_asal');
     }
 
     // Relasi hasMany ke Penerbangan (tujuan)
     public function penerbanganTujuan()
     {
         return $this->hasMany(Penerbangan::class, 'id_bandara_tujuan');
     }

     // Relasi hasMany ke PesanTiket (asal)
    public function pesanTiketAsal()
    {
        return $this->hasMany(PesanTiket::class, 'id_bandara_asal');
    }

    // Relasi hasMany ke PesanTiket (tujuan)
    public function pesanTiketTujuan()
    {
        return $this->hasMany(PesanTiket::class, 'id_bandara_tujuan');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'id_kota'); // Bandara belongsTo Kota
    }
}
