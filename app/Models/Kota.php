<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    // Tentukan nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'kota';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'slug', 
        'nama_kota', 
        'latitude', 
        'longitude',
    ];

    // Tentukan kolom yang tidak boleh diisi
    protected $guarded = [];

    public function bandaras()
    {
        return $this->hasMany(Bandara::class, 'id_kota'); // Kota hasMany Bandara
    }
}
