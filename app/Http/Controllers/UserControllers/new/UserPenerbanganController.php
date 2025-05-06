<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\Bandara;
use App\Models\Penerbangan;
use App\Models\Maskapai;
use Illuminate\Http\Request;

class UserPenerbanganController extends Controller
{

    public function search(Request $request)
    {
        // Ambil inputan dari form
        $bandaraAsal = $request->input('bandara_asal');
        $bandaraTujuan = $request->input('bandara_tujuan');
        $tanggal = $request->input('tanggal');
        $namaKelas = $request->input('kelas');  // Menambahkan kelas filter
        $jumlahPenumpang = $request->input('jumlah_penumpang');
        $maskapaiId = $request->input('maskapai_id');

        // Ambil data penerbangan berdasarkan filter
        $penerbangan = Penerbangan::with(['pesawat.kelas', 'pesawat.maskapai', 'bandaraAsal', 'bandaraTujuan'])
            ->when($bandaraAsal, function ($query) use ($bandaraAsal) {
                return $query->whereIn('id_bandara_asal', $bandaraAsal);
            })
            ->when($bandaraTujuan, function ($query) use ($bandaraTujuan) {
                return $query->whereIn('id_bandara_tujuan', $bandaraTujuan);
            })


            ->when($tanggal, function ($query) use ($tanggal) {
                return $query->whereDate('tanggal_berangkat', $tanggal);
            })
            ->when($namaKelas, function ($query) use ($namaKelas) {
                return $query->whereHas('pesawat.kelas', function ($query) use ($namaKelas) {
                    $query->whereIn('nama_kelas', is_array($namaKelas) ? $namaKelas : [$namaKelas]);
                });
            })
            ->when($maskapaiId, function ($query) use ($maskapaiId) {
                return $query->whereHas('pesawat.maskapai', function ($query) use ($maskapaiId) {
                    $query->where('id', $maskapaiId);
                });
            })
            ->paginate(10)
            ->withQueryString(); // agar filter tetap terpakai saat pindah halaman

        // Ambil daftar bandara untuk dropdown
        $bandaraList = Bandara::all();
        // Ambil daftar maskapai untuk dropdown
        $maskapaiList = Maskapai::all();
        // Daftar kelas penerbangan
        $kelasList = ['ekonomi', 'bisnis', 'first'];  // Sesuaikan dengan kelas yang ada di sistem

        // Kirim data ke view
        return view('user-pages.daftar-penerbangan', [
            'penerbangan' => $penerbangan,
            'bandaraList' => $bandaraList,
            'maskapaiList' => $maskapaiList,
            'kelasList' => $kelasList,
        ]);
    }


    public function autocomplete(Request $request)
    {
        $term = $request->get('term');

        $bandara = Bandara::with('kota') // pastikan relasi 'kota' sudah dibuat
            ->where('nama_bandara', 'LIKE', "%$term%")
            ->orWhereHas('kota', function ($query) use ($term) {
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

        return view('user-pages.homepage', $data);
    }
}
