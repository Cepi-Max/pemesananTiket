@extends('admin.layouts.main.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Bandara</h2>

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

    <form method="POST" action="{{ route('bandara.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nama_bandara" class="form-label">Nama Bandara</label>
            <input type="text" class="form-control" id="nama_bandara" name="nama_bandara" required>
        </div>

        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="number" step="any" class="form-control" id="latitude" name="latitude" required>
        </div>

        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="number" step="any" class="form-control" id="longitude" name="longitude" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('bandara.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
