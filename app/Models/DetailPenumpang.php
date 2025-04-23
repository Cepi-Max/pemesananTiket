<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenumpang extends Model
{
    use HasFactory;

    // Tentukan nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'detail_penumpang';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_pemesanan_tiket',
        'nama_penumpang',
        'jenis_kelamin',
        'tipe_penumpang',
    ];

    // Relasi dengan PesanTiket (belongsTo)
    public function pesanTiket()
    {
        return $this->belongsTo(PesanTiket::class, 'id_pemesanan_tiket');
    }
}
