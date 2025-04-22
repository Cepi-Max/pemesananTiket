@extends('admin.layouts.main.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-2 mt-3">
                    <a href="{{ route('AboutUs.form', $AboutUs->id ?? '') }}" class="btn btn-dark btn-sm d-flex align-items-center justify-content-center w-80">
                        <span>{{ isset($AboutUs) ? 'Ubah' : 'Tambah' }} Informasi</span>
                    </a>
                </div>
                <div class="col-md-4">
                    <form action="#">
                        @foreach (['category', 'author'] as $filter)
                            @if (request($filter))
                                <input type="hidden" name="{{ $filter }}" value="{{ request($filter) }}">
                            @endif
                        @endforeach
                        <div class="search-container">
                            <input type="text" class="search-input" placeholder="cari informasi" id="search" name="search" required autocomplete="off">
                            <button class="search-button" type="submit">
                                <i class="fas fa-search"></i>
                                <span>Cari</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Desktop -->
    <div class="card shadow d-none d-md-block">
        <div class="card-header bg-dark text-white">
            <h5 class="card-title mb-0">About Us</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 15%">Profil</th>
                            <th style="width: 15%">Visi dan Misi</th>
                            <th style="width: 15%">Gambar Struktur Organisasi</th>
                            <th style="width: 15%">Alamat</th>
                            <th style="width: 15%">Kontak</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">1</td>
                            <td class="align-middle">{{ \Illuminate\Support\Str::limit($AboutUs->profil, 30) }}</td>
                            <td class="align-middle">{{ \Illuminate\Support\Str::limit($AboutUs->visi_misi, 30) }}</td>
                            <td class="align-middle">
                                @if($AboutUs->gambar_struktur_organisasi && $AboutUs->gambar_struktur_organisasi !== 'default.png')
                                    <img src="{{ Storage::url('images/publicImg/AboutUs/AboutUsImg/' . $AboutUs->gambar_struktur_organisasi) }}" alt="Struktur Organisasi" width="100">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="align-middle">{{ $AboutUs->alamat }}</td>
                            <td class="align-middle">{{ $AboutUs->kontak }}</td>
                            <td class="align-middle">
                                <a href="{{ route('AboutUs.form', $AboutUs->id) }}" class="btn btn-warning btn-sm" title="Edit informasi" data-bs-toggle="tooltip">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
