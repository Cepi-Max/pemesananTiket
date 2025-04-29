<?php

namespace App\Http\Controllers;

use App\Models\DetailPenumpang;
use Illuminate\Http\Request;

class DetailPenumpangController extends Controller
{
    // Menampilkan semua penumpang per order
    public function index($orderSlug)
    {
        $detailPenumpang = DetailPenumpang::where('order_slug', $orderSlug)->get(); // Ambil semua data penumpang berdasarkan order_slug

        return view('detail_penumpang.index', compact('detailPenumpang'));
    }

    // Menampilkan form tambah penumpang
    public function create($orderSlug)
    {
        return view('detail_penumpang.create', compact('orderSlug')); // Menampilkan form untuk menambah penumpang
    }

    // Menyimpan data penumpang ke database
    public function store(Request $request, $orderSlug)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_identitas' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        // Simpan data penumpang ke database
        DetailPenumpang::create([
            'order_slug' => $orderSlug,
            'nama' => $request->nama,
            'no_identitas' => $request->no_identitas,
            'alamat' => $request->alamat,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('detail-penumpang.index', $orderSlug)->with('success', 'Penumpang berhasil ditambahkan.');
    }

    // Menampilkan form edit penumpang berdasarkan ID
    public function edit($id)
    {
        $penumpang = DetailPenumpang::findOrFail($id); // Ambil data penumpang berdasarkan ID

        return view('detail_penumpang.edit', compact('penumpang')); // Kirim data penumpang ke form edit
    }

    // Menyimpan perubahan penumpang
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_identitas' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        $penumpang = DetailPenumpang::findOrFail($id); // Ambil data penumpang berdasarkan ID

        // Update data penumpang
        $penumpang->update([
            'nama' => $request->nama,
            'no_identitas' => $request->no_identitas,
            'alamat' => $request->alamat,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('detail-penumpang.index', $penumpang->order_slug)->with('success', 'Penumpang berhasil diperbarui.');
    }

    // Menghapus penumpang berdasarkan ID
    public function destroy($id)
    {
        $penumpang = DetailPenumpang::findOrFail($id); // Ambil data penumpang berdasarkan ID
        $orderSlug = $penumpang->order_slug; // Simpan order_slug untuk redirect setelah hapus
        $penumpang->delete(); // Hapus data penumpang

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('detail-penumpang.index', $orderSlug)->with('success', 'Penumpang berhasil dihapus.');
    }
}
