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

        return redirect()->route('show.profile')->with('success', 'Data berhasil diperbarui');
    }
    
}
