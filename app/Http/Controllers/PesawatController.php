<?php

namespace App\Http\Controllers;

use App\Models\Pesawat;
use App\Models\Maskapai;
use App\Models\KelasPesawat;
use Illuminate\Http\Request;

class PesawatController extends Controller
{
    // Menampilkan semua pesawat
    public function index()
    {
        $pesawats = Pesawat::all(); // Ambil semua data pesawat dari database
        return view('pesawat.index', compact('pesawat')); // Kirim data pesawat ke view
    }

    // Menampilkan form tambah pesawat
    public function create()
    {
        $maskapis = Maskapai::all(); // Ambil semua maskapai untuk dropdown
        $kelasPesawats = KelasPesawat::all(); // Ambil semua kelas pesawat untuk dropdown
        return view('pesawat.create', compact('maskapai', 'kelasPesawat')); // Menampilkan form untuk menambah pesawat
    }

    // Menyimpan pesawat ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'slug' => 'required|unique:pesawat',
            'kode_pesawat' => 'required',
            'id_maskapai' => 'required|exists:maskapai,id',
            'id_kelas' => 'required|exists:kelas_pesawat,id',
            'jumlah_kursi' => 'required|integer|min:1',
        ]);

        // Simpan data pesawat ke database
        Pesawat::create([
            'slug' => $request->slug,
            'kode_pesawat' => $request->kode_pesawat,
            'id_maskapai' => $request->id_maskapai,
            'id_kelas' => $request->id_kelas,
            'jumlah_kursi' => $request->jumlah_kursi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesawat.index')->with('success', 'Pesawat berhasil ditambahkan.');
    }

    // Menampilkan form edit pesawat
    public function edit($id)
    {
        $pesawat = Pesawat::findOrFail($id); // Ambil data pesawat berdasarkan ID
        $maskapis = Maskapai::all(); // Ambil semua maskapai untuk dropdown
        $kelasPesawats = KelasPesawat::all(); // Ambil semua kelas pesawat untuk dropdown
        return view('pesawat.edit', compact('pesawat', 'maskapai', 'kelasPesawat')); // Kirim data pesawat ke form edit
    }

    // Menyimpan perubahan pesawat
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'slug' => 'required|unique:pesawat,slug,' . $id,
            'kode_pesawat' => 'required',
            'id_maskapai' => 'required|exists:maskapai,id',
            'id_kelas' => 'required|exists:kelas_pesawat,id',
            'jumlah_kursi' => 'required|integer|min:1',
        ]);

        $pesawat = Pesawat::findOrFail($id); // Ambil data pesawat berdasarkan ID
        $pesawat->update([
            'slug' => $request->slug,
            'kode_pesawat' => $request->kode_pesawat,
            'id_maskapai' => $request->id_maskapai,
            'id_kelas' => $request->id_kelas,
            'jumlah_kursi' => $request->jumlah_kursi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesawat.index')->with('success', 'Pesawat berhasil diperbarui.');
    }

    // Menghapus pesawat
    public function destroy($id)
    {
        $pesawat = Pesawat::findOrFail($id); // Ambil data pesawat berdasarkan ID
        $pesawat->delete(); // Hapus data pesawat

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pesawat.index')->with('success', 'Pesawat berhasil dihapus.');
    }
}
