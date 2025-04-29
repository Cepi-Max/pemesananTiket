<?php

namespace App\Http\Controllers;

use App\Models\Maskapai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MaskapaiController extends Controller
{
    // Menampilkan semua maskapai
    public function index()
    {
        $maskapai = Maskapai::all(); // Ambil semua data maskapai

        return view('maskapai.index', compact('maskapai'));
    }

    // Menampilkan form tambah maskapai
    public function create()
    {
        return view('maskapai.create'); // Menampilkan form untuk menambah maskapai
    }

    // Menyimpan maskapai ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_maskapai' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Menyimpan logo ke public/storage dan mendapatkan path
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        } else {
            $logoPath = 'default.jpg';
        }

        // Membuat slug dari nama maskapai
        $slug = Str::slug($request->nama_maskapai);
        $existingSlugCount = Maskapai::where('slug', 'LIKE', "{$slug}%")->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Simpan data maskapai ke database
        Maskapai::create([
            'slug' => $slug,
            'nama_maskapai' => $request->nama_maskapai,
            'logo' => $logoPath,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('maskapai.index')->with('success', 'Maskapai berhasil ditambahkan.');
    }

    // Menampilkan form edit maskapai berdasarkan slug
    public function edit($slug)
    {
        $maskapai = Maskapai::where('slug', $slug)->firstOrFail(); // Ambil data maskapai berdasarkan slug

        return view('maskapai.edit', compact('maskapai')); // Kirim data maskapai ke form edit
    }

    // Menyimpan perubahan maskapai berdasarkan slug
    public function update(Request $request, $slug)
    {
        // Validasi data input
        $request->validate([
            'nama_maskapai' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $maskapai = Maskapai::where('slug', $slug)->firstOrFail(); // Ambil data maskapai berdasarkan slug

        // Menyimpan logo baru jika ada
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        } else {
            $logoPath = $maskapai->logo;
        }

        // Update data maskapai
        $maskapai->update([
            'nama_maskapai' => $request->nama_maskapai,
            'logo' => $logoPath,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('maskapai.index')->with('success', 'Maskapai berhasil diperbarui.');
    }

    // Menghapus maskapai berdasarkan slug
    public function destroy($slug)
    {
        $maskapai = Maskapai::where('slug', $slug)->firstOrFail(); // Ambil data maskapai berdasarkan slug
        $maskapai->delete(); // Hapus data maskapai

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('maskapai.index')->with('success', 'Maskapai berhasil dihapus.');
    }
}
