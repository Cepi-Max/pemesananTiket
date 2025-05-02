<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    // Menampilkan semua promo
    public function index()
    {
        $promos = Promo::all(); // Ambil semua data promo dari database
        return view('admin.promo.index', compact('promos')); // Kirim data promo ke view
    }

    // Menampilkan form tambah promo
    public function create()
    {
        return view('admin.promo.create'); // Menampilkan form untuk menambah promo
    }

    // Menyimpan promo ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'slug' => 'required|unique:promo',
            'kode_promo' => 'required',
            'jumlah_%' => 'nullable|numeric|min:0|max:100',
            'jumlah_rp' => 'nullable|numeric|min:0',
        ]);

        // Simpan data promo ke database
        Promo::create([
            'slug' => $request->slug,
            'kode_promo' => $request->kode_promo,
            'jumlah_%' => $request->jumlah_ ?? null,
            'jumlah_rp' => $request->jumlah_rp ?? null,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    // Menampilkan form edit promo
    public function edit($id)
    {
        $promo = Promo::findOrFail($id); // Ambil data promo berdasarkan ID
        return view('admin.promo.edit', compact('promo')); // Kirim data promo ke form edit
    }

    // Menyimpan perubahan promo
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'slug' => 'required|unique:promos,slug,' . $id,
            'kode_promo' => 'required',
            'jumlah_%' => 'nullable|numeric|min:0|max:100',
            'jumlah_rp' => 'nullable|numeric|min:0',
        ]);

        $promo = Promo::findOrFail($id); // Ambil data promo berdasarkan ID
        $promo->update([
            'slug' => $request->slug,
            'kode_promo' => $request->kode_promo,
            'jumlah_%' => $request->input('jumlah_%') ?? null,
            'jumlah_rp' => $request->jumlah_rp ?? null,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil diperbarui.');
    }

    // Menghapus promo
    public function destroy($id)
    {
        $promo = Promo::findOrFail($id); // Ambil data promo berdasarkan ID
        $promo->delete(); // Hapus data promo

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil dihapus.');
    }
}
