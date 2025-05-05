<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;


class PesanTiket extends Model
{
    use HasFactory;

    protected $table = 'pesan_tiket';

    protected $fillable = [
        'kode_booking',
        'id_orderer',
        'nama_pemesan',
        'email_pemesan',
        'telp_pemesan',
        'gender_pemesan',
        'id_penerbangan',
        'tanggal_berangkat',
        'tanggal_tiba',
        'jam_berangkat',
        'id_bandara_asal',
        'id_bandara_tujuan',
        'id_pesawat',
        'total_harga',
        'status',
    ];

    // Relasi hasMany ke DetailPenumpang
    public function detailPenumpangs()
    {
        return $this->hasMany(DetailPenumpang::class, 'id_pemesanan_tiket');
    }

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

    // Relasi dengan Penerbangan (belongsTo)
    public function penerbangan()
    {
        return $this->belongsTo(Penerbangan::class, 'id_penerbangan');
    }

    // Relasi dengan User (belongsTo)
    public function orderer()
    {
        return $this->belongsTo(User::class, 'id_orderer');
    }
    // Relasi One-to-One dengan tabel payments
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
