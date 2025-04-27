@extends('admin.layouts.main.app')

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    {{-- Tampilkan error validasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Kota --}}
    <form action="{{ route('admin.kota.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_kota" class="form-label">Nama Kota</label>
            <input type="text" name="nama_kota" id="nama_kota" class="form-control" value="{{ old('nama_kota') }}" required>
        </div>

        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="number" step="any" name="latitude" id="latitude" class="form-control" value="{{ old('latitude') }}" required>
        </div>

        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="number" step="any" name="longitude" id="longitude" class="form-control" value="{{ old('longitude') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.kota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
