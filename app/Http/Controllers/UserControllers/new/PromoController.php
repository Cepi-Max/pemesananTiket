<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    // Menampilkan semua promo (untuk admin)
    public function index()
    {
        $promos = Promo::all();
        return view('admin.promo.index', compact('promos'));
    }

    // Menampilkan form tambah promo
    public function create()
    {
        return view('admin.promo.create');
    }

    // Menyimpan promo ke database
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:promo',
            'kode_promo' => 'required',
            'jumlah_%' => 'nullable|numeric|min:0|max:100',
            'jumlah_rp' => 'nullable|numeric|min:0',
        ]);

        Promo::create([
            'slug' => $request->slug,
            'kode_promo' => $request->kode_promo,
            'jumlah_%' => $request->input('jumlah_%') ?? null,
            'jumlah_rp' => $request->jumlah_rp ?? null,
        ]);

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    // Menampilkan form edit promo
    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        return view('admin.promo.edit', compact('promo'));
    }

    // Menyimpan perubahan promo
    public function update(Request $request, $id)
    {
        $request->validate([
            'slug' => 'required|unique:promo,slug,' . $id,
            'kode_promo' => 'required',
            'jumlah_%' => 'nullable|numeric|min:0|max:100',
            'jumlah_rp' => 'nullable|numeric|min:0',
        ]);

        $promo = Promo::findOrFail($id);
        $promo->update([
            'slug' => $request->slug,
            'kode_promo' => $request->kode_promo,
            'jumlah_%' => $request->input('jumlah_%') ?? null,
            'jumlah_rp' => $request->jumlah_rp ?? null,
        ]);

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil diperbarui.');
    }

    // Menghapus promo
    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil dihapus.');
    }

    // Menampilkan promo ke dashboard sebagai card
    // public function dashboard()
    // {
    //     $promos = Promo::all();
    //     return view('user-pages.homepage', compact('promos'));
    // }

    // Menampilkan detail promo berdasarkan slug
    public function show($slug)
    {
        $promo = Promo::where('slug', $slug)->firstOrFail();
        $promos = Promo::latest()->get(); // Urutkan berdasarkan waktu dibuat

        return view('user-pages.detailPromo', compact('promo', 'promos'));
    }
}
