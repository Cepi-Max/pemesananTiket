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
        $kelasPesawats = KelasPesawat::all(); // Ambil semua data kelas pesawat dari database
        return view('admin.kelas_pesawat.index', compact('kelasPesawats')); // Kirim data kelas pesawat ke view
    }

    // Menampilkan form tambah kelas pesawat
    public function create()
    {
        return view('admin.kelas_pesawat.create'); // Menampilkan form untuk menambah kelas pesawat
    }

    // Menyimpan kelas pesawat ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_kelas' => 'required',
        ]);

        // Tangani Slug
        $slug = Str::slug($request->input('nama_kelas'));
        $existingSlugCount = KelasPesawat::where('slug', 'LIKE', "{$slug}%")->count();

        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Simpan data kelas pesawat ke database
        KelasPesawat::create([
            'slug' => $slug,
            'nama_kelas' => $request->nama_kelas,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kelas_pesawat.index')->with('success', 'Kelas pesawat berhasil ditambahkan.');
    }

    // Menampilkan form edit kelas pesawat
    public function edit($id)
    {
        $kelasPesawat = KelasPesawat::findOrFail($id); // Ambil data kelas pesawat berdasarkan ID
        return view('admin.kelas_pesawat.edit', compact('kelasPesawat')); // Kirim data kelas pesawat ke form edit
    }

    // Menyimpan perubahan kelas pesawat
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nama_kelas' => 'required',
        ]);

        $kelasPesawat = KelasPesawat::findOrFail($id); 

        $slug = Str::slug($request->input('nama_kelas'));

        $kelasPesawat->update([
            'slug' => $slug,
            'nama_kelas' => $request->nama_kelas,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kelas_pesawat.index')->with('success', 'Kelas pesawat berhasil diperbarui.');
    }

    // Menghapus kelas pesawat
    public function destroy($id)
    {
        $kelasPesawat = KelasPesawat::findOrFail($id); // Ambil data kelas pesawat berdasarkan ID
        $kelasPesawat->delete(); // Hapus data kelas pesawat

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kelas_pesawat.index')->with('success', 'Kelas pesawat berhasil dihapus.');
    }
}
