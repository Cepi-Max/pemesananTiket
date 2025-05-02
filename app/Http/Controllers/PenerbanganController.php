<?php

namespace App\Http\Controllers;

use App\Models\Penerbangan;
use App\Models\Bandara;
use App\Models\Pesawat;
use Illuminate\Http\Request;

class PenerbanganController extends Controller
{
    // Menampilkan semua penerbangan
    public function index()
    {
        $penerbangans = Penerbangan::all(); // Ambil semua data penerbangan dari database
        return view('admin.penerbangan.index', compact('penerbangans')); // Kirim data penerbangan ke view
    }

    // Menampilkan form tambah penerbangan
    public function create()
    {
        $bandaras = Bandara::all(); // Ambil semua bandara untuk dropdown
        $pesawats = Pesawat::all(); // Ambil semua pesawat untuk dropdown
        return view('admin.penerbangan.create', compact('bandara', 'pesawat')); // Menampilkan form untuk menambah penerbangan
    }

    // Menyimpan penerbangan ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'slug' => 'required|unique:penerbangan',
            'tanggal_berangkat' => 'required|date',
            'tanggal_tiba' => 'required|date',
            'jam_berangkat' => 'required|date_format:H:i',
            'id_bandara_asal' => 'required|exists:bandara,id',
            'id_bandara_tujuan' => 'required|exists:bandara,id',
            'id_pesawat' => 'required|exists:pesawat,id',
            'maks_penumpang' => 'required|integer|min:1',
            'harga_dewasa' => 'required|numeric|min:0',
            'harga_anak' => 'required|numeric|min:0',
        ]);

        // Simpan data penerbangan ke database
        Penerbangan::create([
            'slug' => $request->slug,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_tiba' => $request->tanggal_tiba,
            'jam_berangkat' => $request->jam_berangkat,
            'id_bandara_asal' => $request->id_bandara_asal,
            'id_bandara_tujuan' => $request->id_bandara_tujuan,
            'id_pesawat' => $request->id_pesawat,
            'maks_penumpang' => $request->maks_penumpang,
            'harga_dewasa' => $request->harga_dewasa,
            'harga_anak' => $request->harga_anak,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.penerbangan.index')->with('success', 'Penerbangan berhasil ditambahkan.');
    }

    // Menampilkan form edit penerbangan
    public function edit($id)
    {
        $penerbangan = Penerbangan::findOrFail($id); // Ambil data penerbangan berdasarkan ID
        $bandaras = Bandara::all(); // Ambil semua bandara untuk dropdown
        $pesawats = Pesawat::all(); // Ambil semua pesawat untuk dropdown
        return view('admin.penerbangan.edit', compact('penerbangan', 'bandara', 'pesawat')); // Kirim data penerbangan ke form edit
    }

    // Menyimpan perubahan penerbangan
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'slug' => 'required|unique:penerbangan,slug,' . $id,
            'tanggal_berangkat' => 'required|date',
            'tanggal_tiba' => 'required|date',
            'jam_berangkat' => 'required|date_format:H:i',
            'id_bandara_asal' => 'required|exists:bandara,id',
            'id_bandara_tujuan' => 'required|exists:bandara,id',
            'id_pesawat' => 'required|exists:pesawat,id',
            'maks_penumpang' => 'required|integer|min:1',
            'harga_dewasa' => 'required|numeric|min:0',
            'harga_anak' => 'required|numeric|min:0',
        ]);

        $penerbangan = Penerbangan::findOrFail($id); // Ambil data penerbangan berdasarkan ID
        $penerbangan->update([
            'slug' => $request->slug,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_tiba' => $request->tanggal_tiba,
            'jam_berangkat' => $request->jam_berangkat,
            'id_bandara_asal' => $request->id_bandara_asal,
            'id_bandara_tujuan' => $request->id_bandara_tujuan,
            'id_pesawat' => $request->id_pesawat,
            'maks_penumpang' => $request->maks_penumpang,
            'harga_dewasa' => $request->harga_dewasa,
            'harga_anak' => $request->harga_anak,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.penerbangan.index')->with('success', 'Penerbangan berhasil diperbarui.');
    }

    // Menghapus penerbangan
    public function destroy($id)
    {
        $penerbangan = Penerbangan::findOrFail($id); // Ambil data penerbangan berdasarkan ID
        $penerbangan->delete(); // Hapus data penerbangan

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.penerbangan.index')->with('success', 'Penerbangan berhasil dihapus.');
    }
}
