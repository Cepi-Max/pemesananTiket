<?php

namespace App\Http\Controllers;

use App\Models\DetailPenumpang;
use App\Models\PesanTiket;
use Illuminate\Http\Request;

class DetailPenumpangController extends Controller
{
    // Menampilkan semua penumpang berdasarkan pesanan
    public function index($pesanTiketId)
    {
        $pesanTiket = PesanTiket::findOrFail($pesanTiketId); // Ambil data pemesanan tiket berdasarkan ID
        $penumpangs = $pesanTiket->detailPenumpangs; // Ambil semua penumpang terkait dengan pemesanan tiket tersebut

        return view('detail_penumpang.index', compact('penumpang', 'pesanTiket')); // Kirim data penumpang ke view
    }

    // Menampilkan form tambah penumpang
    public function create($pesanTiketId)
    {
        $pesanTiket = PesanTiket::findOrFail($pesanTiketId); // Ambil data pemesanan tiket berdasarkan ID
        return view('detail_penumpang.create', compact('pesanTiket')); // Menampilkan form untuk menambah penumpang
    }

    // Menyimpan penumpang ke database
    public function store(Request $request, $pesanTiketId)
    {
        // Validasi data input
        $request->validate([
            'nama_penumpang' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P', // L: Laki-laki, P: Perempuan
            'tipe_penumpang' => 'required|in:dewasa,anak-anak',
        ]);

        // Temukan pemesanan tiket berdasarkan ID
        $pesanTiket = PesanTiket::findOrFail($pesanTiketId);

        // Simpan data penumpang ke database
        DetailPenumpang::create([
            'id_pemesanan_tiket' => $pesanTiket->id,
            'nama_penumpang' => $request->nama_penumpang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tipe_penumpang' => $request->tipe_penumpang,
        ]);

        // Redirect ke halaman daftar penumpang dengan pesan sukses
        return redirect()->route('detail_penumpang.index', $pesanTiketId)->with('success', 'Penumpang berhasil ditambahkan.');
    }

    // Menampilkan form edit penumpang
    public function edit($pesanTiketId, $id)
    {
        $penumpang = DetailPenumpang::findOrFail($id); // Ambil data penumpang berdasarkan ID
        return view('detail_penumpang.edit', compact('penumpang', 'pesanTiketId')); // Kirim data penumpang ke form edit
    }

    // Menyimpan perubahan penumpang
    public function update(Request $request, $pesanTiketId, $id)
    {
        // Validasi data input
        $request->validate([
            'nama_penumpang' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P', // L: Laki-laki, P: Perempuan
            'tipe_penumpang' => 'required|in:dewasa,anak-anak',
        ]);

        $penumpang = DetailPenumpang::findOrFail($id); // Ambil data penumpang berdasarkan ID
        $penumpang->update([
            'nama_penumpang' => $request->nama_penumpang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tipe_penumpang' => $request->tipe_penumpang,
        ]);

        // Redirect ke halaman daftar penumpang dengan pesan sukses
        return redirect()->route('detail_penumpang.index', $pesanTiketId)->with('success', 'Penumpang berhasil diperbarui.');
    }

    // Menghapus penumpang
    public function destroy($pesanTiketId, $id)
    {
        $penumpang = DetailPenumpang::findOrFail($id); // Ambil data penumpang berdasarkan ID
        $penumpang->delete(); // Hapus data penumpang

        // Redirect ke halaman daftar penumpang dengan pesan sukses
        return redirect()->route('detail_penumpang.index', $pesanTiketId)->with('success', 'Penumpang berhasil dihapus.');
    }
}
