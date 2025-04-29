<?php

namespace App\Http\Controllers;

use App\Models\KelasPesawat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasPesawatController extends Controller
{
    // Menampilkan semua kelas pesawat
    public function index()
    {
        $kelasPesawat = KelasPesawat::all(); // Ambil semua data kelas pesawat

        return view('kelas_pesawat.index', compact('kelasPesawat'));
    }

    // Menampilkan form tambah kelas pesawat
    public function create()
    {
        return view('kelas_pesawat.create'); // Menampilkan form untuk menambah kelas pesawat
    }

    // Menyimpan kelas pesawat ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        // Membuat slug dari nama kelas
        $slug = Str::slug($request->nama_kelas);
        $existingSlugCount = KelasPesawat::where('slug', 'LIKE', "{$slug}%")->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Simpan data kelas pesawat ke database
        KelasPesawat::create([
            'slug' => $slug,
            'nama_kelas' => $request->nama_kelas,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelas-pesawat.index')->with('success', 'Kelas pesawat berhasil ditambahkan.');
    }

    // Menampilkan form edit kelas pesawat berdasarkan slug
    public function edit($slug)
    {
        $kelasPesawat = KelasPesawat::where('slug', $slug)->firstOrFail(); // Ambil data kelas pesawat berdasarkan slug

        return view('kelas_pesawat.edit', compact('kelasPesawat')); // Kirim data kelas pesawat ke form edit
    }

    // Menyimpan perubahan kelas pesawat berdasarkan slug
    public function update(Request $request, $slug)
    {
        // Validasi data input
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $kelasPesawat = KelasPesawat::where('slug', $slug)->firstOrFail(); // Ambil data kelas pesawat berdasarkan slug

        // Update data kelas pesawat
        $kelasPesawat->update([
            'nama_kelas' => $request->nama_kelas,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelas-pesawat.index')->with('success', 'Kelas pesawat berhasil diperbarui.');
    }

    // Menghapus kelas pesawat berdasarkan slug
    public function destroy($slug)
    {
        $kelasPesawat = KelasPesawat::where('slug', $slug)->firstOrFail(); // Ambil data kelas pesawat berdasarkan slug
        $kelasPesawat->delete(); // Hapus data kelas pesawat

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelas-pesawat.index')->with('success', 'Kelas pesawat berhasil dihapus.');
    }
}
