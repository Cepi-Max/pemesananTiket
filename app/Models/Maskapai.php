<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maskapai extends Model
{
    use HasFactory;

    // Tentukan nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'maskapai';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'slug', 
        'nama_maskapai', 
        'logo',
    ];

    // Tentukan kolom yang tidak boleh diisi
    protected $guarded = [];

    // Mengatur nilai default untuk logo
    protected $attributes = [
        'logo' => 'default.jpg',
    ];

     // Relasi hasMany ke Pesawat
     public function pesawat()
     {
         return $this->hasMany(Pesawat::class, 'id_maskapai');
     }
}
