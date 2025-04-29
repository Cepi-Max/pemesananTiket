<?php

namespace App\Http\Controllers;

use App\Models\Pesawat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PesawatController extends Controller
{
    // Menampilkan semua pesawat
    public function index()
    {
        $pesawat = Pesawat::all(); // Ambil semua data pesawat

        return view('pesawat.index', compact('pesawat'));
    }

    // Menampilkan form tambah pesawat
    public function create()
    {
        return view('pesawat.create'); // Menampilkan form untuk menambah pesawat
    }

    // Menyimpan pesawat ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kode_pesawat' => 'required|string|max:255|unique:pesawats',
            'nama_pesawat' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        // Membuat slug dari nama pesawat
        $slug = Str::slug($request->nama_pesawat);
        $existingSlugCount = Pesawat::where('slug', 'LIKE', "{$slug}%")->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Simpan data pesawat ke database
        Pesawat::create([
            'slug' => $slug,
            'kode_pesawat' => $request->kode_pesawat,
            'nama_pesawat' => $request->nama_pesawat,
            'kapasitas' => $request->kapasitas,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesawat.index')->with('success', 'Pesawat berhasil ditambahkan.');
    }

    // Menampilkan form edit pesawat berdasarkan slug
    public function edit($slug)
    {
        $pesawat = Pesawat::where('slug', $slug)->firstOrFail(); // Ambil data pesawat berdasarkan slug

        return view('pesawat.edit', compact('pesawat')); // Kirim data pesawat ke form edit
    }

    // Menyimpan perubahan pesawat berdasarkan slug
    public function update(Request $request, $slug)
    {
        // Validasi data input
        $request->validate([
            'kode_pesawat' => 'required|string|max:255|unique:pesawats,kode_pesawat,' . $slug . ',slug',
            'nama_pesawat' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        $pesawat = Pesawat::where('slug', $slug)->firstOrFail(); // Ambil data pesawat berdasarkan slug

        // Update data pesawat
        $pesawat->update([
            'kode_pesawat' => $request->kode_pesawat,
            'nama_pesawat' => $request->nama_pesawat,
            'kapasitas' => $request->kapasitas,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesawat.index')->with('success', 'Pesawat berhasil diperbarui.');
    }

    // Menghapus pesawat berdasarkan slug
    public function destroy($slug)
    {
        $pesawat = Pesawat::where('slug', $slug)->firstOrFail(); // Ambil data pesawat berdasarkan slug
        $pesawat->delete(); // Hapus data pesawat

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesawat.index')->with('success', 'Pesawat berhasil dihapus.');
    }
}
