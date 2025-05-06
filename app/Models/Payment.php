<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesan_tiket_id',
        'payment_method',
        'amount',
        'payment_status',
        'paid_at',
        'payment_proof'
    ];

    // Relasi Many-to-One dengan tabel pesan_tikets
    public function pesanTiket()
    {
        return $this->belongsTo(PesanTiket::class);
    }
}
