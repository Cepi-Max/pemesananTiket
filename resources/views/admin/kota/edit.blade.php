@extends('admin.layouts.main.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">{{ $title }}</h1>

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

    {{-- Form Edit Kota --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.kota.update', $kota->slug) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_kota" class="form-label">Nama Kota</label>
                    <input type="text" name="nama_kota" id="nama_kota" class="form-control" value="{{ old('nama_kota', $kota->nama_kota) }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-dark">Update</button>
                    <a href="{{ route('admin.kota.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
