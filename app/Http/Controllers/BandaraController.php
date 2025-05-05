<?php

namespace App\Http\Controllers;

use App\Models\Bandara;
use Illuminate\Http\Request;

class BandaraController extends Controller
{
    public function index()
    {
        $bandaras = Bandara::all();
        return view('admin.bandara.index', compact('bandaras'));
    }

    public function create()
    {
        return view('bandara.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bandara' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Bandara::create($request->all());

        return redirect()->route('bandara.index')->with('success', 'Bandara berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bandara = Bandara::findOrFail($id);
        return view('admin.bandara.edit', compact('bandara'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bandara' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $bandara = Bandara::findOrFail($id);
        $bandara->update($request->all());

        return redirect()->route('admin.bandara.index')->with('success', 'Bandara berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bandara = Bandara::findOrFail($id);
        $bandara->delete();

        return redirect()->route('admin.bandara.index')->with('success', 'Bandara berhasil dihapus.');
    }
}
