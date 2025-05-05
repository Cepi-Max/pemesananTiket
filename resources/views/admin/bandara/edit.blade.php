@extends('admin.layouts.main.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Bandara</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('bandara.update', $bandara->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_bandara" class="form-label">Nama Bandara</label>
            <input type="text" class="form-control" id="nama_bandara" name="nama_bandara" value="{{ old('nama_bandara', $bandara->nama_bandara) }}" required>
        </div>

        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="number" step="any" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $bandara->latitude) }}" required>
        </div>

        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="number" step="any" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $bandara->longitude) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('bandara.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
