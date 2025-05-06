<?php

namespace App\Http\Controllers;
use App\Models\Penerbangan;
use App\Models\Promo;
use Illuminate\Http\Request;

class DaftarPenerbanganController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input filter
        $request->validate([
            'asal' => 'required|string',
            'tujuan' => 'required|string',
            'tanggal_keberangkatan' => 'required|date',
            'kelas' => 'nullable|string',
            'maskapai' => 'nullable|string',
        ]);

        // Ambil data filter dari request
        $asal = $request->input('asal');
        $tujuan = $request->input('tujuan');
        $tanggalKeberangkatan = $request->input('tanggal_keberangkatan');
        $kelas = $request->input('kelas');
        $maskapai = $request->input('maskapai');

        // Query dasar penerbangan
        $query = Penerbangan::with(['bandaraAsal', 'bandaraTujuan', 'pesawat'])
                            ->whereHas('bandaraAsal', function ($q) use ($asal) {
                                $q->where('nama_bandara', 'like', '%' . $asal . '%');
                            })
                            ->whereHas('bandaraTujuan', function ($q) use ($tujuan) {
                                $q->where('nama_bandara', 'like', '%' . $tujuan . '%');
                            })
                            ->whereDate('tanggal_berangkat', $tanggalKeberangkatan);

        // Jika filter kelas dipilih, tambahkan ke query
        if ($kelas) {
            $query->where('kelas', $kelas);
        }

        // Jika filter maskapai dipilih, tambahkan ke query
        if ($maskapai) {
            $query->where('maskapai', 'like', '%' . $maskapai . '%');
        }

        // Menambahkan filter promo jika ada (contoh)
        // Ambil promo yang berlaku pada tanggal keberangkatan
        $promoQuery = Promo::where('tanggal_mulai', '<=', $tanggalKeberangkatan)
                           ->where('tanggal_berakhir', '>=', $tanggalKeberangkatan)
                           ->get();

        // Jika ada promo yang aktif, kita filter penerbangan yang berlaku
        if ($promoQuery->isNotEmpty()) {
            // Menambahkan filter promo jika promo ditemukan
            $query->whereHas('promo', function ($q) use ($promoQuery) {
                $q->whereIn('id', $promoQuery->pluck('id'));
            });
        }

        // Ambil data penerbangan yang sudah difilter
        $penerbangan = $query->get();

        // Tampilkan data ke view
        return view('daftar-penerbangan.index', compact('penerbangan'));
    }
}
