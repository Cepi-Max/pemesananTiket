<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Maskapai;
use Illuminate\Http\Request;

class MaskapaiController extends Controller
{
    // Menampilkan semua maskapai
    public function index()
    {
        $maskapis = Maskapai::all(); // Ambil semua data maskapai dari database
        return view('admin.maskapai.index', compact('maskapis')); // Kirim data maskapai ke view
    }

    // Menampilkan form tambah maskapai
    public function create()
    {
        return view('admin.maskapai.create'); // Menampilkan form untuk menambah maskapai
    }

    // Menyimpan maskapai ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'slug' => 'required|unique:maskapai',
            'nama_maskapai' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Menyimpan logo jika ada
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // Simpan data maskapai ke database
        Maskapai::create([
            'slug' => $request->slug,
            'nama_maskapai' => $request->nama_maskapai,
            'logo' => $logoPath ?? 'default.jpg', // Gunakan logo default jika tidak ada logo yang diupload
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.maskapai.index')->with('success', 'Maskapai berhasil ditambahkan.');
    }

    // Menampilkan form edit maskapai
    public function edit($id)
    {
        $maskapai = Maskapai::findOrFail($id); // Ambil data maskapai berdasarkan ID
        return view('admin.maskapai.edit', compact('maskapai')); // Kirim data maskapai ke form edit
    }

    // Menyimpan perubahan maskapai
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'slug' => 'required|unique:maskapai,slug,' . $id,
            'nama_maskapai' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $maskapai = Maskapai::findOrFail($id); // Ambil data maskapai berdasarkan ID

        // Menyimpan logo baru jika ada
        $logoPath = $maskapai->logo;
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($logoPath && $logoPath !== 'default.jpg') {
                Storage::delete('public/' . $logoPath);
            }
            // Upload logo baru
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // Update data maskapai
        $maskapai->update([
            'slug' => $request->slug,
            'nama_maskapai' => $request->nama_maskapai,
            'logo' => $logoPath,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.maskapai.index')->with('success', 'Maskapai berhasil diperbarui.');
    }

    // Menghapus maskapai
    public function destroy($id)
    {
        $maskapai = Maskapai::findOrFail($id); // Ambil data maskapai berdasarkan ID

        // Hapus logo jika ada dan bukan default
        if ($maskapai->logo && $maskapai->logo !== 'default.jpg') {
            Storage::delete('public/' . $maskapai->logo);
        }

        // Hapus data maskapai
        $maskapai->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.maskapai.index')->with('success', 'Maskapai berhasil dihapus.');
    }
}
