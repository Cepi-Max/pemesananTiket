<?php

namespace App\Http\Controllers;
use App\Models\PesanTiket;
use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    // Menampilkan form pembayaran
    public function showForm($pesanTiketId)
    {
        $pesanTiket = PesanTiket::findOrFail($pesanTiketId);
        return view('payment.form', compact('pesanTiket'));
    }

    // Menyimpan pembayaran dan update status
    public function store(Request $request, $pesanTiketId)
    {
        // Validasi input
        $validated = $request->validate([
            'payment_method' => 'required|string',
            'payment_proof' => 'required|image',
        ]);

        $pesanTiket = PesanTiket::findOrFail($pesanTiketId);

        // Simpan bukti pembayaran (upload file)
        $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Simpan data pembayaran
        $payment = Payment::create([
            'pesan_tiket_id' => $pesanTiketId,
            'payment_method' => $request->payment_method,
            'amount' => $pesanTiket->total_harga,
            'payment_status' => 'pending', // Status sementara sebelum diverifikasi
            'payment_proof' => $paymentProofPath,
        ]);

        // Update status pesan_tiket menjadi confirmed
        $pesanTiket->update([
            'status' => 'confirmed',
        ]);

        // Kirim email dengan PDF tiket
        $this->sendInvoiceEmail($pesanTiket);

        return redirect()->route('payment.status', ['orderId' => $payment->id])
                         ->with('success', 'Pembayaran berhasil, harap menunggu konfirmasi!');
    }

    // Mengirim email dengan PDF tiket
    private function sendInvoiceEmail($pesanTiket)
    {
        // Buat PDF tiket
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('payment.invoice', compact('pesanTiket'));

        // Kirim email dengan attachment PDF
        Mail::to($pesanTiket->user->email)->send(new \App\Mail\TiketEmail($pesanTiket, $pdf));
    }

    // Halaman status pembayaran
    public function status($orderId)
    {
        $payment = Payment::findOrFail($orderId);
        return view('payment.status', compact('payment'));
    }
}

