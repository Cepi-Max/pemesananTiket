<?php

namespace App\Http\Controllers;

use App\Models\DownloadAbleFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class DownloadAbleFileontroller extends Controller
{
    public function index()
    {
        $DownloadAbleFile = DownloadAbleFile::first(); 
        $data = [
            'title' => 'About Us',
            'DownloadAbleFile' => $DownloadAbleFile
        ];
        return view('admin.downloadablefile.index', $data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jadwal_penerbangan' => 'nullable|mimes:pdf|max:2048',
            'brosur_pariwisata' => 'nullable|mimes:pdf|max:2048',
            'syarat_ketentuan' => 'nullable|mimes:pdf|max:2048',
        ]);

        $DownloadAbleFile = DownloadAbleFile::where('id', $id)->firstOrFail();

        $DownloadAbleFile->profil = $request->input('profil');
        $DownloadAbleFile->visi_misi = $request->input('visi_misi');
        // Tangani file jadwal penerbangan
        if ($request->hasFile('jadwal_penerbangan') && $request->file('jadwal_penerbangan')->isValid()) {
            $file = $request->file('jadwal_penerbangan');
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = 'files/DownloadAbleFile/' . $fileName;

            if ($DownloadAbleFile->jadwal_penerbangan && $DownloadAbleFile->jadwal_penerbangan !== 'default.png') {
                Storage::disk('public')->delete('files/DownloadAbleFile/' . $DownloadAbleFile->jadwal_penerbangan);
            }

            Storage::disk('public')->put($path, file_get_contents($file));
            $DownloadAbleFile->jadwal_penerbangan = $fileName;
        }
        // Tangani file jadwal penerbangan
        if ($request->hasFile('brosur_pariwisata') && $request->file('brosur_pariwisata')->isValid()) {
            $file = $request->file('brosur_pariwisata');
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = 'files/DownloadAbleFile/' . $fileName;

            if ($DownloadAbleFile->brosur_pariwisata && $DownloadAbleFile->brosur_pariwisata !== 'default.png') {
                Storage::disk('public')->delete('files/DownloadAbleFile/' . $DownloadAbleFile->brosur_pariwisata);
            }

            Storage::disk('public')->put($path, file_get_contents($file));
            $DownloadAbleFile->brosur_pariwisata = $fileName;
        }
        // Tangani file jadwal penerbangan
        if ($request->hasFile('syarat_ketentuan') && $request->file('syarat_ketentuan')->isValid()) {
            $file = $request->file('syarat_ketentuan');
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = 'files/DownloadAbleFile/' . $fileName;

            if ($DownloadAbleFile->syarat_ketentuan && $DownloadAbleFile->syarat_ketentuan !== 'default.png') {
                Storage::disk('public')->delete('files/DownloadAbleFile/' . $DownloadAbleFile->syarat_ketentuan);
            }

            Storage::disk('public')->put($path, file_get_contents($file));
            $DownloadAbleFile->syarat_ketentuan = $fileName;
        }
    
        $DownloadAbleFile->save();

        return redirect()->route('DownloadAbleFile.edit')->with('success', 'Data berhasil diperbarui');
    }
        
}
