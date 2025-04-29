<?php

namespace App\Http\Controllers;

use App\Models\PesanTiket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PesanTiketController extends Controller
{
    // Menampilkan semua pesanan tiket
    public function index()
    {
        $pesanTiket = PesanTiket::all(); // Ambil semua data pesanan tiket

        return view('pesan_tiket.index', compact('pesanTiket'));
    }

    // Menampilkan form pesan tiket
    public function create()
    {
        return view('pesan_tiket.create'); // Menampilkan form untuk pesan tiket
    }

    // Menyimpan pesanan tiket ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kode_pesanan' => 'required|string|max:255|unique:pesan_tikets',
            'nama_pemesan' => 'required|string|max:255',
            'jumlah_tiket' => 'required|integer',
            'jadwal_penerbangan' => 'required|date',
            'total_harga' => 'required|numeric',
        ]);

        // Membuat slug dari kode pesanan
        $slug = Str::slug($request->kode_pesanan);
        $existingSlugCount = PesanTiket::where('slug', 'LIKE', "{$slug}%")->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Simpan data pesanan tiket ke database
        PesanTiket::create([
            'slug' => $slug,
            'kode_pesanan' => $request->kode_pesanan,
            'nama_pemesan' => $request->nama_pemesan,
            'jumlah_tiket' => $request->jumlah_tiket,
            'jadwal_penerbangan' => $request->jadwal_penerbangan,
            'total_harga' => $request->total_harga,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesan-tiket.index')->with('success', 'Pesanan tiket berhasil ditambahkan.');
    }

    // Menampilkan detail pesanan tiket berdasarkan slug
    public function show($slug)
    {
        $pesanTiket = PesanTiket::where('slug', $slug)->firstOrFail(); // Ambil data pesanan tiket berdasarkan slug

        return view('pesan_tiket.show', compact('pesanTiket')); // Kirim data pesanan tiket ke view
    }

    // Menampilkan form edit pesanan tiket berdasarkan slug
    public function edit($slug)
    {
        $pesanTiket = PesanTiket::where('slug', $slug)->firstOrFail(); // Ambil data pesanan tiket berdasarkan slug

        return view('pesan_tiket.edit', compact('pesanTiket')); // Kirim data pesanan tiket ke form edit
    }

    // Menyimpan perubahan pesanan tiket berdasarkan slug
    public function update(Request $request, $slug)
    {
        // Validasi data input
        $request->validate([
            'kode_pesanan' => 'required|string|max:255|unique:pesan_tikets,kode_pesanan,' . $slug . ',slug',
            'nama_pemesan' => 'required|string|max:255',
            'jumlah_tiket' => 'required|integer',
            'jadwal_penerbangan' => 'required|date',
            'total_harga' => 'required|numeric',
        ]);

        $pesanTiket = PesanTiket::where('slug', $slug)->firstOrFail(); // Ambil data pesanan tiket berdasarkan slug

        // Update data pesanan tiket
        $pesanTiket->update([
            'kode_pesanan' => $request->kode_pesanan,
            'nama_pemesan' => $request->nama_pemesan,
            'jumlah_tiket' => $request->jumlah_tiket,
            'jadwal_penerbangan' => $request->jadwal_penerbangan,
            'total_harga' => $request->total_harga,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesan-tiket.index')->with('success', 'Pesanan tiket berhasil diperbarui.');
    }

    // Menghapus pesanan tiket berdasarkan slug
    public function destroy($slug)
    {
        $pesanTiket = PesanTiket::where('slug', $slug)->firstOrFail(); // Ambil data pesanan tiket berdasarkan slug
        $pesanTiket->delete(); // Hapus data pesanan tiket

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesan-tiket.index')->with('success', 'Pesanan tiket berhasil dihapus.');
    }
}
