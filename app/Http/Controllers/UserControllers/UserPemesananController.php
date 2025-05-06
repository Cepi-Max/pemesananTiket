<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\DetailPenumpang;
use App\Models\Penerbangan;
use App\Models\PesanTiket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserPemesananController extends Controller
{
    public function form(Request $request, $slug)
    {
        $penerbangan = Penerbangan::with('pesawat.kelas')->where('slug', $slug)->firstOrFail();
        $jumlahPenumpang = $request->jumlah_penumpang;

        if (!$jumlahPenumpang || $jumlahPenumpang <= 0) {
            return redirect()->back()->with('error', 'Jumlah penumpang tidak valid.');
        }

        return view('user-pages.form-pemesanan', compact('penerbangan', 'jumlahPenumpang'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'email_pemesan' => 'required|email|max:255',
            'telp_pemesan' => 'required|string|max:20',
            'gender_pemesan' => 'required|in:L,P',
            'penerbangan_id' => 'required|exists:penerbangan,id',
            'jumlah_penumpang' => 'required|integer|min:1',
            'penumpang' => 'required|array|min:1',
            'penumpang.*.nama' => 'required|string|max:255',
            'penumpang.*.gender' => 'required|in:L,P',
        ]);

        $penerbangan = Penerbangan::with('bandaraAsal', 'bandaraTujuan', 'pesawat')->findOrFail($request->penerbangan_id);
        // dd($penerbangan);

        $totalHarga = $penerbangan->harga_dewasa * $request->jumlah_penumpang;

        $kodeBooking = strtoupper(Str::random(8));

        $userId = Auth::id() ?? null;

        $pemesanan = DB::transaction(function () use ($request, $penerbangan, $totalHarga, $kodeBooking, $userId) {
            $pesanan = PesanTiket::create([
                'kode_booking' => $kodeBooking,
                'id_orderer' => $userId,
                'nama_pemesan' => $request->nama_pemesan,
                'email_pemesan' => $request->email_pemesan,
                'telp_pemesan' => $request->telp_pemesan,
                'gender_pemesan' => $request->gender_pemesan,
                'id_penerbangan' => $penerbangan->id,
                'total_harga' => $totalHarga,
                'status' => 'Menunggu Pembayaran',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($request->penumpang as $penumpang) {
                DetailPenumpang::create([
                    'id_pemesanan_tiket' => $pesanan->id,
                    'nama_penumpang' => $penumpang['nama'],
                    'jenis_kelamin' => $penumpang['gender'],
                    'tipe_penumpang' => 'dewasa',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            session(['kode_booking' => $kodeBooking]); // simpan untuk lanjut ke pembayaran

            // return $pesanan;
        });

        return view('user-pages.payment-page', ['totalHarga' => $totalHarga]);
    }

    public function bayar(Request $request)
    {
        $request->validate([
            'kode_booking' => 'required|string|exists:pesan_tiket,kode_booking'
        ]);

        $pesanan = PesanTiket::where('kode_booking', $request->kode_booking)->firstOrFail();

        // Simulasikan "pembayaran berhasil"
        $pesanan->status = 'Sudah Dibayar';
        $pesanan->save();

        return redirect()->route('tiket.jadi', $pesanan->kode_booking);
    }

    public function tiket($kodeBooking)
    {
        $pesanan = PesanTiket::with(['penerbangan.bandaraAsal', 'penerbangan.bandaraTujuan', 'detailPenumpangs'])
        ->where('kode_booking', $kodeBooking)
        ->firstOrFail();

        return view('user-pages.tiket-jadi', compact('pesanan'));
    }

    public function downloadTiket(Request $request)
    {
        // Ambil data pemesanan berdasarkan kode_booking
        $pesanan = PesanTiket::with(['penerbangan.bandaraAsal', 'penerbangan.bandaraTujuan', 'detailPenumpangs'])
            ->where('kode_booking', $request->kode_booking)
            ->firstOrFail();

        // Siapkan data untuk view PDF
        $data = [
            'kode_booking' => $pesanan->kode_booking,
            'nama_pemesan' => $pesanan->nama_pemesan,
            'email_pemesan' => $pesanan->email_pemesan,
            'telp_pemesan' => $pesanan->telp_pemesan,
            'status' => $pesanan->status,
            'penerbangan' => $pesanan->penerbangan,
            'penumpangs' => $pesanan->detailPenumpangs,
        ];

        // Generate PDF
        $pdf = PDF::loadView('user-pages.tiket-pdf', $data);

        // Mengembalikan response PDF sebagai file download
        return $pdf->download('Tiket_'.$pesanan->kode_booking.'.pdf');
    }


}
