<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    // Menampilkan semua promo
    public function index()
    {
        $promo = Promo::all(); // Ambil semua data promo

        return view('promo.index', compact('promo'));
    }

    // Menampilkan form tambah kode promo
    public function create()
    {
        return view('promo.create'); // Menampilkan form untuk menambah kode promo
    }

    // Menyimpan promo ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kode_promo' => 'required|string|max:255|unique:promos',
            'diskon' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        // Membuat slug dari kode promo
        $slug = Str::slug($request->kode_promo);
        $existingSlugCount = Promo::where('slug', 'LIKE', "{$slug}%")->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Simpan data promo ke database
        Promo::create([
            'slug' => $slug,
            'kode_promo' => $request->kode_promo,
            'diskon' => $request->diskon,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    // Menampilkan form edit promo berdasarkan slug
    public function edit($slug)
    {
        $promo = Promo::where('slug', $slug)->firstOrFail(); // Ambil data promo berdasarkan slug

        return view('promo.edit', compact('promo')); // Kirim data promo ke form edit
    }

    // Menyimpan perubahan promo berdasarkan slug
    public function update(Request $request, $slug)
    {
        // Validasi data input
        $request->validate([
            'kode_promo' => 'required|string|max:255|unique:promos,kode_promo,' . $slug . ',slug',
            'diskon' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        $promo = Promo::where('slug', $slug)->firstOrFail(); // Ambil data promo berdasarkan slug

        // Update data promo
        $promo->update([
            'kode_promo' => $request->kode_promo,
            'diskon' => $request->diskon,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('promo.index')->with('success', 'Promo berhasil diperbarui.');
    }

    // Menghapus promo berdasarkan slug
    public function destroy($slug)
    {
        $promo = Promo::where('slug', $slug)->firstOrFail(); // Ambil data promo berdasarkan slug
        $promo->delete(); // Hapus data promo

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('promo.index')->with('success', 'Promo berhasil dihapus.');
    }
}
