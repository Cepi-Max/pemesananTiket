<?php

namespace App\Http\Controllers;

use App\Models\PesanTiket;
use App\Models\Penerbangan;
use App\Models\User;
use App\Models\Bandara;
use App\Models\Pesawat;
use Illuminate\Http\Request;

class PesanTiketController extends Controller
{
    // Menampilkan semua pesanan tiket
    public function index()
    {
        $pesanTikets = PesanTiket::all(); // Ambil semua data pesanan tiket dari database
        return view('pesan_tiket.index', compact('pesanTiket')); // Kirim data pesanan tiket ke view
    }

    // Menampilkan form pesan tiket
    public function create()
    {
        $penerbangans = Penerbangan::all(); // Ambil semua penerbangan untuk dropdown
        $users = User::all(); // Ambil semua user untuk dropdown
        $bandaras = Bandara::all(); // Ambil semua bandara untuk dropdown
        $pesawats = Pesawat::all(); // Ambil semua pesawat untuk dropdown
        return view('pesan_tiket.create', compact('penerbangan', 'users', 'bandara', 'pesawat')); // Menampilkan form untuk pesan tiket
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
        ]);

        // Simpan data pesanan tiket ke database
        PesanTiket::create([
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

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesan_tiket.index')->with('success', 'Pesanan tiket berhasil ditambahkan.');
    }

    // Menampilkan detail pesanan tiket
    public function show($id)
    {
        $pesanTiket = PesanTiket::findOrFail($id); // Ambil data pesanan tiket berdasarkan ID
        return view('pesan_tiket.show', compact('pesanTiket')); // Kirim data pesanan tiket ke view detail
    }

    // Menampilkan form edit pesanan tiket
    public function edit($id)
    {
        $pesanTiket = PesanTiket::findOrFail($id); // Ambil data pesanan tiket berdasarkan ID
        $penerbangans = Penerbangan::all(); // Ambil semua penerbangan untuk dropdown
        $users = User::all(); // Ambil semua user untuk dropdown
        $bandaras = Bandara::all(); // Ambil semua bandara untuk dropdown
        $pesawats = Pesawat::all(); // Ambil semua pesawat untuk dropdown
        return view('pesan_tiket.edit', compact('pesanTiket', 'penerbangan', 'users', 'bandara', 'pesawat')); // Kirim data pesanan tiket ke form edit
    }

    // Menyimpan perubahan pesanan tiket
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'kode_booking' => 'required|unique:pesan_tiket,kode_booking,' . $id,
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
        ]);

        $pesanTiket = PesanTiket::findOrFail($id); // Ambil data pesanan tiket berdasarkan ID
        $pesanTiket->update([
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

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesan_tiket.index')->with('success', 'Pesanan tiket berhasil diperbarui.');
    }

    // Menghapus pesanan tiket
    public function destroy($id)
    {
        $pesanTiket = PesanTiket::findOrFail($id); // Ambil data pesanan tiket berdasarkan ID
        $pesanTiket->delete(); // Hapus data pesanan tiket

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesan_tiket.index')->with('success', 'Pesanan tiket berhasil dihapus.');
    }
}
