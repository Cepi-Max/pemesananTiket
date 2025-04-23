<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesawat extends Model
{
    use HasFactory;

    // Tentukan nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'pesawat';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'slug', 
        'kode_pesawat', 
        'id_maskapai', 
        'id_kelas', 
        'jumlah_kursi',
    ];

    // Relasi dengan Maskapai (belongsTo)
    public function maskapai()
    {
        return $this->belongsTo(Maskapai::class, 'id_maskapai');
    }

    // Relasi dengan KelasPesawat (belongsTo)
    public function kelas()
    {
        return $this->belongsTo(KelasPesawat::class, 'id_kelas');
    }

     // Relasi hasMany ke Penerbangan
     public function penerbangan()
     {
         return $this->hasMany(Penerbangan::class, 'id_pesawat');
     }

     // Relasi hasMany ke PesanTiket
    public function pesanTiket()
    {
        return $this->hasMany(PesanTiket::class, 'id_pesawat');
    }
}
