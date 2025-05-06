@extends('admin.layouts.main.app')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
</div>
@endif
    <!-- Tabel Desktop -->
    <div class="card shadow d-none d-md-block">
        <div class="card-header bg-dark text-white">
            <h5 class="card-title mb-0">About Us</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('AboutUs.update', $AboutUs->id) }}" method="post" enctype="multipart/form-data">
                @csrf
    
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="profil" class="form-label">Profil</label>
                        <textarea class="summernote form-control @error('profil') is-invalid @enderror" id="profil" name="profil" rows="5" placeholder="Masukkan Profil">{{ old('profil', $AboutUs->profil ?? '') }}</textarea>
                        @error('profil')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="visi" class="form-label">Visi</label>
                        <textarea class="summernote form-control @error('visi') is-invalid @enderror" id="visi" name="visi" rows="5" placeholder="Masukkan Visi">{{ old('visi', $AboutUs->visi ?? '') }}</textarea>
                        @error('visi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="misi" class="form-label">Misi</label>
                        <textarea class="summernote form-control @error('misi') is-invalid @enderror" id="misi" name="misi" rows="5" placeholder="Masukkan Misi">{{ old('misi', $AboutUs->misi ?? '') }}</textarea>
                        @error('misi')
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
    
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
