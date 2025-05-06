<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KotaController extends Controller
{
    // Menampilkan semua kota
    public function index()
    {
        $kota = Kota::all(); // Ambil semua data kota dari database

        $data = [
            'title' => 'Daftar Kota',
            'kota' => $kota
        ];

        return view('admin.kota.index', $data); 
    }

    // Menampilkan form tambah kota
    public function create()
    {

        $data = [
            'title' => 'Form Tambah Kota',
        ];

        return view('admin.kota.create', $data); // Menampilkan form untuk menambah kota
    }

    // Menyimpan kota ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_kota' => 'required',
        ], [
            'nama_kota.required' => 'nama kota harus diisi.',
        ]);
        
        // Buat Slug itu otomatis Fadil
        $slug = Str::slug($request->input('nama_kota'));
        // klo ada nama kota yg sama tambahin angka biar beda
        $existingSlugCount = Kota::where('slug', 'LIKE', "{$slug}%")->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }
        // Simpan data kota ke database
        Kota::create([
            'slug' => $slug,
            'nama_kota' => $request->nama_kota,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kota.index')->with('success', 'Kota berhasil ditambahkan.');
    }

    // Menampilkan form edit kota
    public function edit($slug)
    {
        $kota = $kota = Kota::where('slug', $slug)->firstOrFail();

        $data = [
            'title' => 'Form Edit Kota',
            'kota' => $kota
        ];

        return view('admin.kota.edit', $data); // Kirim data kota ke form edit
    }

    // Menyimpan perubahan kota
    public function update(Request $request, $slug)
    {
        // Validasi data input
        $request->validate([
            'nama_kota' => 'required',
        ], [
            'nama_kota.required' => 'nama kota harus diisi.',
        ]);

        $kota = Kota::where('slug', $slug)->firstOrFail();

        $slug = Str::slug($request->input('nama_kota'));
        $kota->update([
            'slug' => $slug,
            'nama_kota' => $request->nama_kota,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kota.index')->with('success', 'Kota berhasil diperbarui.');
    }

    // Menghapus kota
    public function destroy($slug)
    {
        $kota = Kota::where('slug', $slug)->firstOrFail();
        $kota->delete(); // Hapus data kota
        return redirect()->route('admin.kota.index')->with('success', 'Kota berhasil dihapus.');
    }
}
