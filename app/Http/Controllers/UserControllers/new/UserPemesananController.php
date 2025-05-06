<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\DetailPenumpang;
use App\Models\Penerbangan;
use App\Models\PesanTiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserPemesananController extends Controller
{
    public function form(Request $request, $slug)
    {
        // Mengambil penerbangan beserta relasi bandaraAsal, bandaraTujuan, pesawat.maskapai, dan pesawat.kelas
        $penerbangan = Penerbangan::with('bandaraAsal', 'bandaraTujuan', 'pesawat.maskapai', 'pesawat.kelas')
            ->where('slug', $slug)
            ->firstOrFail();

        $jumlahPenumpang = $request->jumlah_penumpang;

        if (!$jumlahPenumpang || $jumlahPenumpang <= 0) {
            return redirect()->back()->with('error', 'Jumlah penumpang tidak valid.');
        }

        return view('user-pages.form-pemesanan', compact('penerbangan', 'jumlahPenumpang'));
    }



    public function submit(Request $request)
    {
        $request->validate([
            'pemesan_nama' => 'required|string|max:255',
            'pemesan_email' => 'required|email|max:255',
            'pemesan_telpon' => 'required|string|max:20',
            'pemesan_gender' => 'required|in:L,P',
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
                'gender_pemesan' => $request->pemesan_gender,
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

            return $pesanan;
        });

        return back()->with('success', 'Pemesanan berhasil! Kode Booking Anda: ' . $kodeBooking);
    }
}
