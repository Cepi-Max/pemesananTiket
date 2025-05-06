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

    <form method="POST" action="{{ route('admin.bandara.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nama_bandara" class="form-label">Nama Bandara</label>
            <input type="text" class="form-control" id="nama_bandara" name="nama_bandara" required>
        </div>

        <div class="mb-3">
            <label for="nama_bandara" class="form-label">Kota Bandara</label>
            <select name="id_kota" id="id_kota" class="form-control custom-select @error('id_kota') is-invalid @enderror">
                <option value="" disabled selected>Pilih Kota</option>
                @foreach ($kota as $k)
                    <option value="{{ $k->id }}">
                        {{ $k->nama_kota }}
                    </option>
                @endforeach
            </select>
        </div>

       

        <button type="submit" class="btn btn-dark">Simpan</button>
        <a href="{{ route('admin.bandara.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>
@endsection
