<?php

namespace App\Http\Controllers;

use App\Models\DashboardImage;
use App\Models\PesanTiket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function index()
    {
        $totalPenjualan = DB::table('detail_penumpang')->count(); // Total tiket terjual
        $totalPendapatan = PesanTiket::where('status', 'paid')
        ->sum('total_harga'); // Total pendapatan yang diterima
        $penjualanPerBulan = PesanTiket::select(DB::raw('YEAR(created_at) as tahun, MONTH(created_at) as bulan, sum(total_harga) as pendapatan'))
        ->where('status', 'paid')
        ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
        ->get();
        $penjualanPerPenerbangan = DB::table('penerbangan')
        ->join('pesan_tiket', 'penerbangan.id', '=', 'pesan_tiket.id_penerbangan')
        ->join('detail_penumpang', 'pesan_tiket.id', '=', 'detail_penumpang.id_pemesanan_tiket')
        ->select('penerbangan.slug', DB::raw('count(detail_penumpang.id) as total_penumpang'))
        ->groupBy('penerbangan.slug')
        ->get();

        

        $data = [
            'title' => 'Beranda Admin',
            'totalPenjualan' => $totalPenjualan,
            'totalPendapatan' => $totalPendapatan,
            'penjualanPerBulan' => $penjualanPerBulan,
            'penjualanPerPenerbangan' => $penjualanPerPenerbangan,
        ];
        return view('admin/dashboard/index', $data);
    }

    function bannerSettingForm()
    {
        $bannerImg = DashboardImage::first();
        $data = [
            'title' => 'Pengaturan Banner',
            'bannerImg' => $bannerImg
        ];

        return view('admin/setting/index', $data);
    }

    function bannerSettingSave(Request $request): RedirectResponse
    {
        $request->validate([
            'image1' => 'nullable|image|max:2560',
            'image2' => 'nullable|image|max:2560',
            'image3' => 'nullable|image|max:2560',
        ], [
            'image1.image' => 'File harus berupa gambar.',
            'image1.max' => 'Ukuran gambar tidak boleh lebih dari 2,5 MB.',
            'image2.image' => 'File harus berupa gambar.',
            'image2.max' => 'Ukuran gambar tidak boleh lebih dari 2,5 MB.',
            'image3.image' => 'File harus berupa gambar.',
            'image3.max' => 'Ukuran gambar tidak boleh lebih dari 2,5 MB.',
        ]);
    
        $imagePaths = [];
    
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField) && $request->file($imageField)->isValid()) {
                $file = $request->file($imageField);
                $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = 'images/general/bannerImg/' . $fileName;
                Storage::disk('public')->put($path, file_get_contents($file));
                $imagePaths[$imageField] = $fileName;
            } else {
                $imagePaths[$imageField] = 'default.png';
            }
        }
    
        $bannerImage = new DashboardImage;
        $bannerImage->author_id = Auth::id();
        $bannerImage->image1 = $imagePaths['image1'];
        $bannerImage->image2 = $imagePaths['image2'];
        $bannerImage->image3 = $imagePaths['image3'];
        $bannerImage->save();
    
        return redirect()->route('show.bannerSettingForm')->with('success', 'Data Berhasil Ditambahkan.');
    }

    function bannerSettingUpdate(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'image1' => 'nullable|image|max:2560',
            'image2' => 'nullable|image|max:2560',
            'image3' => 'nullable|image|max:2560',
        ], [
            'image1.image' => 'File harus berupa gambar.',
            'image1.max' => 'Ukuran gambar tidak boleh lebih dari 2,5 MB.',
            'image2.image' => 'File harus berupa gambar.',
            'image2.max' => 'Ukuran gambar tidak boleh lebih dari 2,5 MB.',
            'image3.image' => 'File harus berupa gambar.',
            'image3.max' => 'Ukuran gambar tidak boleh lebih dari 2,5 MB.',
        ]);
    
        $bannerImageById = DashboardImage::where('id', $id)->firstOrFail();
        $imagePaths = [];

        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField) && $request->file($imageField)->isValid()) {
                $file = $request->file($imageField);
                $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = 'images/general/bannerImg/' . $fileName;

                // Hapus gambar lama jika ada dan bukan default.png
                if ($bannerImageById->$imageField && $bannerImageById->$imageField !== 'default.png') {
                    Storage::disk('public')->delete('images/general/bannerImg/' . $bannerImageById->$imageField);
                }

                // Simpan gambar baru
                Storage::disk('public')->put($path, file_get_contents($file));
                $imagePaths[$imageField] = $fileName;
            } else {
                // Jika tidak ada upload baru, pakai data lama
                $imagePaths[$imageField] = $bannerImageById->$imageField ?? 'default.png';
            }
        }

        $bannerImageById->update($imagePaths);

    
        return redirect()->route('show.bannerSettingForm')->with('success', 'Data Berhasil Diubah.');
    }
}
