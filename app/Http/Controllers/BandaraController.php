<?php

namespace App\Http\Controllers;

use App\Models\Bandara;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BandaraController extends Controller
{
    public function index()
    {
        $bandaras = Bandara::all();
        return view('admin.bandara.index', compact('bandaras'));
    }

    public function create()
    {
        $kota = Kota::all();
        return view('admin.bandara.create', compact('kota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bandara' => 'required|string|max:255',
            'id_kota' => 'required',
        ]);
        
        $slug = Str::slug($request->input('nama_bandara'));
        // klo ada nama kota yg sama tambahin angka biar beda
        $existingSlugCount = Bandara::where('slug', 'LIKE', "{$slug}%")->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }
        
        Bandara::create([
            'slug' => $slug,
            'nama_bandara' => $request->nama_bandara,
            'id_kota' => $request->id_kota,
        ]);
        
        return redirect()->route('admin.bandara.index')->with('success', 'Bandara berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bandara = Bandara::findOrFail($id);
        $kota = Kota::all();
        return view('admin.bandara.edit', compact('bandara', 'kota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bandara' => 'required|string|max:255',
            'id_kota' => 'required',
        ]);

        $bandara = Bandara::findOrFail($id);

        $slug = Str::slug($request->input('nama_bandara'));
        $slugExists = Bandara::where('slug', $slug)
        ->where('id', '!=', $id)
        ->exists();

        if ($slugExists) {
        $slug .= '-' . uniqid(); // tambahkan uniqid supaya tetap unik
        }

        $bandara->update(
            [
                'slug' => $slug,
                'nama_bandara' => $request->nama_bandara,
                'id_kota' => $request->id_kota,
            ]
        );

        return redirect()->route('admin.bandara.index')->with('success', 'Bandara berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bandara = Bandara::findOrFail($id);
        $bandara->delete();

        return redirect()->route('admin.bandara.index')->with('success', 'Bandara berhasil dihapus.');
    }
}
