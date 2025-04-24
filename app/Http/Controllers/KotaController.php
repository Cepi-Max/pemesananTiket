<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    // Menampilkan semua kota
    public function index()
    {
        $kotas = Kota::all(); // Ambil semua data kota dari database
        return view('kota.index', compact('kota')); // Kirim data kota ke view
    }

    // Menampilkan form tambah kota
    public function create()
    {
        return view('kota.create'); // Menampilkan form untuk menambah kota
    }

    // Menyimpan kota ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'slug' => 'required|unique:kota',
            'nama_kota' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Simpan data kota ke database
        Kota::create([
            'slug' => $request->slug,
            'nama_kota' => $request->nama_kota,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kota.index')->with('success', 'Kota berhasil ditambahkan.');
    }

    // Menampilkan form edit kota
    public function edit($id)
    {
        $kota = Kota::findOrFail($id); // Ambil data kota berdasarkan ID
        return view('kota.edit', compact('kota')); // Kirim data kota ke form edit
    }

    // Menyimpan perubahan kota
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'slug' => 'required|unique:kota,slug,' . $id,
            'nama_kota' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $kota = Kota::findOrFail($id); // Ambil data kota berdasarkan ID
        $kota->update([
            'slug' => $request->slug,
            'nama_kota' => $request->nama_kota,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kota.index')->with('success', 'Kota berhasil diperbarui.');
    }

    // Menghapus kota
    public function destroy($id)
    {
        $kota = Kota::findOrFail($id); // Ambil data kota berdasarkan ID
        $kota->delete(); // Hapus data kota

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kota.index')->with('success', 'Kota berhasil dihapus.');
    }
}
