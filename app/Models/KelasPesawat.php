<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPesawat extends Model
{
    use HasFactory;

    // Tentukan nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'kelas_pesawat';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'slug', 
        'nama_kelas',
    ];

    // Tentukan kolom yang tidak boleh diisi
    protected $guarded = [];

     // Relasi hasMany ke Pesawat
     public function pesawat()
     {
         return $this->hasMany(Pesawat::class, 'id_kelas');
     }
}
