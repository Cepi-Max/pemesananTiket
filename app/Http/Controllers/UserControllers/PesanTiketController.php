<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\PesanTiket;
use App\Models\Penerbangan;
use App\Models\User;
use App\Models\Bandara;
use App\Models\Pesawat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PesanTiketController extends Controller
{
    // Menampilkan semua pesanan tiket
    public function index()
    {
        $pesanTikets = PesanTiket::all();
        return view('pesan_tiket.index', compact('pesanTikets'));
    }

    // Menampilkan form pesan tiket
    public function create()
    {
        $penerbangans = Penerbangan::all();
        $users = User::all();
        $bandaras = Bandara::all();
        $pesawats = Pesawat::all();
        return view('pesan_tiket.create', compact('penerbangans', 'users', 'bandaras', 'pesawats'));
    }

    // Menampilkan ringkasan penerbangan sebelum pembayaran
    public function ringkasan(Request $request)
    {
        // Validasi ID penerbangan yang dipilih
        $penerbangan = Penerbangan::findOrFail($request->id_penerbangan);
        
        // Menampilkan form pemesanan dengan ringkasan penerbangan
        return view('pesan_tiket.ringkasan', compact('penerbangan', 'request'));
    }

    // Menyimpan pesanan tiket ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kode_booking' => 'required|unique:pesan_tiket',
            'id_orderer' => 'required|exists:users,id',
            'id_penerbangan' => 'required|exists:penerbangan,id',
            'tanggal_berangkat' => 'required|date',
            'tanggal_tiba' => 'required|date',
            'jam_berangkat' => 'required|date_format:H:i',
            'id_bandara_asal' => 'required|exists:bandara,id',
            'id_bandara_tujuan' => 'required|exists:bandara,id',
            'id_pesawat' => 'required|exists:pesawat,id',
            'total_harga' => 'required|numeric|min:0',
            'status' => 'required|string',
            'penumpang' => 'required|array', // Array of penumpang data
        ]);

        // Simpan data pesanan tiket ke database
        $pesanTiket = PesanTiket::create([
            'kode_booking' => $request->kode_booking,
            'id_orderer' => $request->id_orderer,
            'id_penerbangan' => $request->id_penerbangan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_tiba' => $request->tanggal_tiba,
            'jam_berangkat' => $request->jam_berangkat,
            'id_bandara_asal' => $request->id_bandara_asal,
            'id_bandara_tujuan' => $request->id_bandara_tujuan,
            'id_pesawat' => $request->id_pesawat,
            'total_harga' => $request->total_harga,
            'status' => $request->status,
        ]);

        // Simpan data penumpang jika ada
        foreach ($request->penumpang as $penumpang) {
            // Misalkan kamu punya model Penumpang yang di-relasikan dengan PesanTiket
            // Penumpang::create([...]);
        }

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesan_tiket.index')->with('success', 'Pesanan tiket berhasil ditambahkan.');
    }

    // Menampilkan detail pesanan tiket
    public function show($id)
    {
        $pesanTiket = PesanTiket::findOrFail($id);
        return view('pesan_tiket.show', compact('pesanTiket'));
    }

    // Menampilkan form edit pesanan tiket
    public function edit($id)
    {
        $pesanTiket = PesanTiket::findOrFail($id);
        $penerbangans = Penerbangan::all();
        $users = User::all();
        $bandaras = Bandara::all();
        $pesawats = Pesawat::all();
        return view('pesan_tiket.edit', compact('pesanTiket', 'penerbangans', 'users', 'bandaras', 'pesawats'));
    }

    // Menghapus pesanan tiket
    public function destroy($id)
    {
        $pesanTiket = PesanTiket::findOrFail($id);
        $pesanTiket->delete();
        return redirect()->route('pesan_tiket.index')->with('success', 'Pesanan tiket berhasil dihapus.');
    }


    

    public function downloadTiket(Request $request)
    {
        $kode = $request->kode_booking;

        $pesanan = PesanTiket::with([
            'penerbangan.pesawat.maskapai',
            'penerbangan.bandaraAsal',
            'penerbangan.bandaraTujuan',
            'detailPenumpangs'
        ])->where('kode_booking', $kode)->firstOrFail();

        $pdf = Pdf::loadView('pdf.tiket', compact('pesanan'));

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Tiket_'.$kode.'.pdf"');
    }

}
