<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbangan extends Model
{
    use HasFactory;

    // Tentukan nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'penerbangan';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'slug',
        'tanggal_berangkat',
        'tanggal_tiba',
        'jam_berangkat',
        'id_bandara_asal',
        'id_bandara_tujuan',
        'id_pesawat',
        'maks_penumpang',
        'harga_dewasa',
        'harga_anak',
    ];

    // Relasi dengan Bandara Asal (belongsTo)
    public function bandaraAsal()
    {
        return $this->belongsTo(Bandara::class, 'id_bandara_asal');
    }

    // Relasi dengan Bandara Tujuan (belongsTo)
    public function bandaraTujuan()
    {
        return $this->belongsTo(Bandara::class, 'id_bandara_tujuan');
    }

    // Relasi dengan Pesawat (belongsTo)
    public function pesawat()
    {
        return $this->belongsTo(Pesawat::class, 'id_pesawat');
    }

    // Relasi hasMany ke PesanTiket
    public function pesanTiket()
    {
        return $this->hasMany(PesanTiket::class, 'id_penerbangan');
    }
}
