<?php

namespace App\Http\Controllers;

use App\Models\Maskapai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'nama_maskapai' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $slug = Str::slug($request->input('nama_maskapai'));
        // klo ada nama kota yg sama tambahin angka biar beda
        $existingSlugCount = Maskapai::where('slug', 'LIKE', "{$slug}%")->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $file = $request->file('logo'); 
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path   = 'images/maskapai/'.$fileName;
            Storage::disk('public')->put($path, file_get_contents($file));
         } else {
             $fileName = 'default.png';
         }

        // Simpan data maskapai ke database
        Maskapai::create([
            'slug' => $slug,
            'nama_maskapai' => $request->nama_maskapai,
            'logo' => $fileName ?? 'default.jpg', // Gunakan logo default jika tidak ada logo yang diupload
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.maskapai.index')->with('success', 'Maskapai berhasil ditambahkan.');
    }

    // Menampilkan form edit maskapai
    public function edit($id)
    {
        $maskapai = Maskapai::findOrFail($id);
        return view('admin.maskapai.edit', compact('maskapai')); // Kirim data maskapai ke form edit
    }

    // Menyimpan perubahan maskapai
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nama_maskapai' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $maskapai = Maskapai::findOrFail($id); // Ambil data maskapai berdasarkan ID

        
        $slug = Str::slug($request->input('nama_maskapai'));

        $maskapai->nama_maskapai = $request->input('nama_maskapai');
        $maskapai->slug = $slug;

        // Tangani file gambar
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $file = $request->file('logo');

            // Buat nama file unik
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = 'images/maskapai/' . $fileName;

            // Hapus gambar lama jika bukan default.png
            if ($maskapai->logo && $maskapai->logo !== 'default.png') {
                Storage::disk('public')->delete('images/maskapai/'.$maskapai->logo);
            }
            Storage::disk('public')->put($path, file_get_contents($file));
            $maskapai->logo = $fileName;
        } else {
            $maskapai->logo = $maskapai->logo ?? 'default.png';
        }
        

        $maskapai->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.maskapai.index')->with('success', 'Maskapai berhasil diperbarui.');
    }

    // Menghapus maskapai
    public function destroy($id)
    {
        $maskapai = Maskapai::findOrFail($id); // Ambil data maskapai berdasarkan ID

        if (!empty($maskapai->logo) && $maskapai->logo !== 'default.png') {
                $filePath = 'images/maskapai/' . $maskapai->logo;
                Storage::disk('public')->delete($filePath);
            }
        // Hapus data maskapai
        $maskapai->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.maskapai.index')->with('success', 'Maskapai berhasil dihapus.');
    }
}
