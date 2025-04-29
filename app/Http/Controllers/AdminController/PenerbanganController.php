<?php

namespace App\Http\Controllers;

use App\Models\Penerbangan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PenerbanganController extends Controller
{
    // Menampilkan semua penerbangan
    public function index()
    {
        $penerbangan = Penerbangan::all(); // Ambil semua data penerbangan

        return view('penerbangan.index', compact('penerbangan'));
    }

    // Menampilkan form tambah penerbangan
    public function create()
    {
        return view('penerbangan.create'); // Menampilkan form untuk menambah penerbangan
    }

    // Menyimpan penerbangan ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kode_penerbangan' => 'required|string|max:255|unique:penerbangans',
            'nama_penerbangan' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'jadwal_berangkat' => 'required|date',
            'jadwal_tiba' => 'required|date',
        ]);

        // Membuat slug dari kode penerbangan
        $slug = Str::slug($request->kode_penerbangan);
        $existingSlugCount = Penerbangan::where('slug', 'LIKE', "{$slug}%")->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Simpan data penerbangan ke database
        Penerbangan::create([
            'slug' => $slug,
            'kode_penerbangan' => $request->kode_penerbangan,
            'nama_penerbangan' => $request->nama_penerbangan,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'jadwal_berangkat' => $request->jadwal_berangkat,
            'jadwal_tiba' => $request->jadwal_tiba,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('penerbangan.index')->with('success', 'Penerbangan berhasil ditambahkan.');
    }

    // Menampilkan form edit penerbangan berdasarkan slug
    public function edit($slug)
    {
        $penerbangan = Penerbangan::where('slug', $slug)->firstOrFail(); // Ambil data penerbangan berdasarkan slug

        return view('penerbangan.edit', compact('penerbangan')); // Kirim data penerbangan ke form edit
    }

    // Menyimpan perubahan penerbangan berdasarkan slug
    public function update(Request $request, $slug)
    {
        // Validasi data input
        $request->validate([
            'kode_penerbangan' => 'required|string|max:255|unique:penerbangans,kode_penerbangan,' . $slug . ',slug',
            'nama_penerbangan' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'jadwal_berangkat' => 'required|date',
            'jadwal_tiba' => 'required|date',
        ]);

        $penerbangan = Penerbangan::where('slug', $slug)->firstOrFail(); // Ambil data penerbangan berdasarkan slug

        // Update data penerbangan
        $penerbangan->update([
            'kode_penerbangan' => $request->kode_penerbangan,
            'nama_penerbangan' => $request->nama_penerbangan,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'jadwal_berangkat' => $request->jadwal_berangkat,
            'jadwal_tiba' => $request->jadwal_tiba,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('penerbangan.index')->with('success', 'Penerbangan berhasil diperbarui.');
    }

    // Menghapus penerbangan berdasarkan slug
    public function destroy($slug)
    {
        $penerbangan = Penerbangan::where('slug', $slug)->firstOrFail(); // Ambil data penerbangan berdasarkan slug
        $penerbangan->delete(); // Hapus data penerbangan

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('penerbangan.index')->with('success', 'Penerbangan berhasil dihapus.');
    }
}
