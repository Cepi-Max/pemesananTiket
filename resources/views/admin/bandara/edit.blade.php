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

    <form action="{{ route('admin.bandara.update', $bandara->id) }}" method="POST" >
        @csrf
        <div class="mb-3">
            <label for="nama_bandara" class="form-label">Nama Bandara</label>
            <input type="text" class="form-control" id="nama_bandara" name="nama_bandara" value="{{ old('nama_bandara', $bandara->nama_bandara) }}" required>
        </div>

        <div class="mb-3">
            <label for="id_kota" class="form-label">Kota</label>
            <select name="id_kota" id="id_kota" class="form-control custom-select @error('id_kota') is-invalid @enderror">
                <option value="" disabled selected>Pilih Kota</option>
                @foreach ($kota as $k)
                    <option value="{{ $k->id }}"
                        {{ old('id_kota', $bandara->id_kota ?? '') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kota }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
        <a href="{{ route('admin.bandara.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>
@endsection
