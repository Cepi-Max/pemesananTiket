<?php

namespace App\Http\Controllers;

use App\Models\DownloadAbleFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class DownloadAbleFileController extends Controller
{
    public function index()
    {
        $DownloadAbleFile = DownloadAbleFile::first(); 
        $data = [
            'title' => 'File Download Data',
            'DownloadAbleFile' => $DownloadAbleFile
        ];
        return view('admin.file-download.index', $data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jadwal_penerbangan' => 'nullable|mimes:pdf|max:2048',
            'brosur_pariwisata' => 'nullable|mimes:pdf|max:2048',
        ]);

        $DownloadAbleFile = DownloadAbleFile::where('id', $id)->firstOrFail();

        // Daftar file yang akan ditangani
        $files = [
            'jadwal_penerbangan' => $DownloadAbleFile->jadwal_penerbangan,
            'brosur_pariwisata' => $DownloadAbleFile->brosur_pariwisata,
            'syarat_ketentuan' => $DownloadAbleFile->syarat_ketentuan,
        ];
        
        foreach ($files as $inputName => $currentFile) {
            // Cek jika ada file yang diupload dan file valid
            if ($request->hasFile($inputName) && $request->file($inputName)->isValid()) {
                $file = $request->file($inputName);
                $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = 'files/DownloadAbleFile/' . $fileName;
        
                // Hapus file yang lama jika ada
                if ($currentFile && $currentFile !== 'default.png') {
                    Storage::disk('public')->delete('files/DownloadAbleFile/' . $currentFile);
                }
        
                // Simpan file baru
                Storage::disk('public')->put($path, file_get_contents($file));
                // Update field terkait di model
                $DownloadAbleFile->$inputName = $fileName;
            }
        }
        
        $DownloadAbleFile->save();
        

        return redirect()->route('show.downloadfile.form')->with('success', 'Data berhasil diperbarui');
    }

    public function previewFile(DownloadAbleFile $filePreview)
{
    // Tentukan path file berdasarkan atribut file pada model
    $filePath1 = 'files/DownloadAbleFile/' . $filePreview->jadwal_penerbangan;
    $filePath2 = 'files/DownloadAbleFile/' . $filePreview->brosur_pariwisata;

    // Cek apakah file jadwal_penerbangan ada
    if ($filePreview == 'jadwal_penerbangan' && Storage::disk('public')->exists($filePath1)) {
        // Ambil file jadwal penerbangan
        $file = Storage::disk('public')->get($filePath1);
        $mimeType = Storage::disk('public')->mimeType($filePath1);

        return response($file, 200)->header('Content-Type', $mimeType);
    }

    // Cek apakah file brosur_pariwisata ada
    if ($filePreview == 'brosur_pariwisata' && Storage::disk('public')->exists($filePath2)) {
        // Ambil file brosur pariwisata
        $file = Storage::disk('public')->get($filePath2);
        $mimeType = Storage::disk('public')->mimeType($filePath2);

        return response($file, 200)->header('Content-Type', $mimeType);
    }

    // Jika tidak ada file yang ditemukan
    return back()->with('error', 'File tidak ditemukan.');
}



    public function downloadFile(DownloadAbleFile $fileDownload)
    {
        $filePath = 'files/DownloadAbleFile/' . $fileDownload->file;

        // Cek apakah file ada di storage
        if (!$fileDownload->file || !Storage::disk('public')->exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        // Kasih nama file saat di-download (biar user lebih ngerti)
        $fileName = 'nama_file' . now()->format('YmdHis') . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

        return Storage::disk('public')->download($filePath, $fileName);
    }
        
}
