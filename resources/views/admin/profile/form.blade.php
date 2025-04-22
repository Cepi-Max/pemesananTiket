@extends('admin.layouts.main.app')

@section('content')  
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="form-container">
        <div class="form-title d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
            <span>Form {{ isset($AboutUs) ? 'Ubah' : 'Tambah' }} Informasi</span>
        </div>

        <form  method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($AboutUs))
                @method('PUT')
            @endif

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="profil" class="form-label">Profil</label>
                    <textarea class="form-control @error('profil') is-invalid @enderror" id="profil" name="profil" rows="5" placeholder="Masukkan Profil">{{ old('profil', $AboutUs->profil ?? '') }}</textarea>
                    @error('profil')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="visi_misi" class="form-label">Visi & Misi</label>
                    <textarea class="form-control @error('visi_misi') is-invalid @enderror" id="visi_misi" name="visi_misi" rows="5" placeholder="Masukkan Visi dan Misi">{{ old('visi_misi', $AboutUs->visi_misi ?? '') }}</textarea>
                    @error('visi_misi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $AboutUs->alamat ?? '') }}" placeholder="Masukkan Alamat">
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak" name="kontak" value="{{ old('kontak', $AboutUs->kontak ?? '') }}" placeholder="Masukkan Kontak">
                    @error('kontak')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="gambar_struktur_organisasi" class="form-label">Gambar Struktur Organisasi</label>
                <input type="file" class="form-control @error('gambar_struktur_organisasi') is-invalid @enderror" id="gambar_struktur_organisasi" name="gambar_struktur_organisasi" accept="image/*">
                
                @if (isset($AboutUs) && $AboutUs->gambar_struktur_organisasi && $AboutUs->gambar_struktur_organisasi !== 'default.png')
                    <div class="mt-3">
                        <img src="{{ Storage::url('images/publicImg/AboutUs/AboutUsImg/' . $AboutUs->gambar_struktur_organisasi) }}" alt="Struktur Organisasi" class="img-fluid">
                    </div>
                @endif

                @error('gambar_struktur_organisasi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('show.profile') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-dark">Simpan</button>
            </div>
        </form>
    </div>
@endsection
