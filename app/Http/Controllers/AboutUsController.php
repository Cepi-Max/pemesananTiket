<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AboutUsController extends Controller
{
    public function index()
    {
        $AboutUs = AboutUs::first(); 
        $data = [
            'title' => 'About Us',
            'AboutUs' => $AboutUs
        ];
        return view('admin.profile.index', $data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'profil' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'alamat' => 'nullable',
            'kontak' => 'nullable',
        ]);

        $AboutUs = AboutUs::where('id', $id)->firstOrFail();

        $AboutUs->profil = $request->input('profil');
        $AboutUs->visi = $request->input('visi');
        $AboutUs->misi = $request->input('misi');
        $AboutUs->alamat = $request->input('alamat');
        $AboutUs->kontak = $request->input('kontak');
        $AboutUs->save();

        return redirect()->route('AboutUs.edit')->with('success', 'Data berhasil diperbarui');
    }
        public function form()
    {
        // $validated = $request->validate([
        //     'profil' => 'required',
        //     'visi_misi' => 'required',
        //     'alamat' => 'nullable|string',
        //     'kontak' => 'nullable|string',
        //     'gambar_struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        // ]);

        // $AboutUs = new AboutUs();
        // $AboutUs->profil = $request->input('profil');
        // $AboutUs->visi_misi = $request->input('visi_misi');
        // $AboutUs->alamat = $request->input('alamat');
        // $AboutUs->kontak = $request->input('kontak');

        // // Menangani gambar jika ada
        // if ($request->hasFile('gambar_struktur_organisasi') && $request->file('gambar_struktur_organisasi')->isValid()) {
        //     $file = $request->file('gambar_struktur_organisasi');
        //     $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        //     $path = 'images/publicImg/AboutUs/AboutUsImg/' . $fileName;
        //     Storage::disk('public')->put($path, file_get_contents($file));
        //     $AboutUs->gambar_struktur_organisasi = $fileName;
        // }

        // $AboutUs->save();

        return view('admin.profile.form');
    }

        
}
