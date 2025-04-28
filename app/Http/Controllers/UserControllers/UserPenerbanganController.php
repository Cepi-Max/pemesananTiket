<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\Bandara;
use App\Models\Penerbangan;
use Illuminate\Http\Request;

class UserPenerbanganController extends Controller
{

    public function search(Request $request)
    {
        $bandaraAsal = $request->input('bandara_asal');
        $bandaraTujuan = $request->input('bandara_tujuan');
        $tanggal = $request->input('tanggal');
        $jumlahPenumpang = $request->input('jumlah_penumpang');

        // Membangun query secara bertahap
        $penerbangan = Penerbangan::with(['bandaraAsal', 'bandaraTujuan'])
            // Cek jika bandara asal diberikan
            ->when($bandaraAsal, function($query) use ($bandaraAsal) {
                return $query->whereHas('bandaraAsal', function($query) use ($bandaraAsal) {
                    $query->where('nama_bandara', 'like', "%$bandaraAsal%");
                });
            })
            // Cek jika bandara tujuan diberikan
            ->when($bandaraTujuan, function($query) use ($bandaraTujuan) {
                return $query->whereHas('bandaraTujuan', function($query) use ($bandaraTujuan) {
                    $query->where('nama_bandara', 'like', "%$bandaraTujuan%");
                });
            })
            // Cek jika tanggal keberangkatan diberikan
            ->when($tanggal, function($query) use ($tanggal) {
                return $query->whereDate('tanggal_berangkat', $tanggal);
            })
            ->get();

        // Data yang akan dikirim ke view
        $data = [
            'title' => 'Daftar Penerbangan',
            'penerbangan' => $penerbangan,
        ];

        return view('daftar-penerbangan', $data);
    }


    public function autocomplete(Request $request)
    {
        $term = $request->get('term');

        $bandara = Bandara::with('kota') // pastikan relasi 'kota' sudah dibuat
            ->where('nama_bandara', 'LIKE', "%$term%")
            ->orWhereHas('kota', function($query) use ($term) {
                $query->where('nama_kota', 'LIKE', "%$term%");
            })
            ->get();

        $result = $bandara->map(function ($item) {
            return [
                'nama_bandara' => $item->nama_bandara,
                'kota' => $item->kota->nama_kota ?? '-', // pastikan ada relasi kota
                'id' => $item->id, // ini id bandara
            ];
        });

        return response()->json($result);
    }


    public function home()
    {
        // Mengambil data galeri dari database
        $penerbangan = Penerbangan::all();

        $data = [
            'penerbangan' => $penerbangan,
        ];

        return view('homepage', $data);
    }

}