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

        <button type="submit" class="btn btn-dark">Simpan</button>
        <a href="{{ route('admin.kota.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>
@endsection
