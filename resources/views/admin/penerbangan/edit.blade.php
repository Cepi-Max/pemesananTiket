@extends('admin.layouts.main.app')

@section('content')
<div class="container">
    <h2>Edit Data Penerbangan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penerbangan.update', $penerbangan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="slug" class="form-label">Kode/Slug Penerbangan</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $penerbangan->slug) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_berangkat" class="form-label">Tanggal & Waktu Berangkat</label>
            <input type="datetime-local" class="form-control" id="tanggal_berangkat" name="tanggal_berangkat" value="{{ old('tanggal_berangkat', \Carbon\Carbon::parse($penerbangan->tanggal_berangkat)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_tiba" class="form-label">Tanggal & Waktu Tiba</label>
            <input type="datetime-local" class="form-control" id="tanggal_tiba" name="tanggal_tiba" value="{{ old('tanggal_tiba', \Carbon\Carbon::parse($penerbangan->tanggal_tiba)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="jam_berangkat" class="form-label">Jam Berangkat (HH:MM)</label>
            <input type="time" class="form-control" id="jam_berangkat" name="jam_berangkat" value="{{ old('jam_berangkat', $penerbangan->jam_berangkat) }}" required>
        </div>

        <div class="mb-3">
            <label for="id_bandara_asal" class="form-label">Bandara Asal</label>
            <select class="form-select" id="id_bandara_asal" name="id_bandara_asal" required>
                <option value="">Pilih Bandara Asal</option>
                @foreach($bandaras as $bandara)
                    <option value="{{ $bandara->id }}" {{ $penerbangan->id_bandara_asal == $bandara->id ? 'selected' : '' }}>
                        {{ $bandara->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_bandara_tujuan" class="form-label">Bandara Tujuan</label>
            <select class="form-select" id="id_bandara_tujuan" name="id_bandara_tujuan" required>
                <option value="">Pilih Bandara Tujuan</option>
                @foreach($bandaras as $bandara)
                    <option value="{{ $bandara->id }}" {{ $penerbangan->id_bandara_tujuan == $bandara->id ? 'selected' : '' }}>
                        {{ $bandara->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_pesawat" class="form-label">Pesawat</label>
            <select class="form-select" id="id_pesawat" name="id_pesawat" required>
                <option value="">Pilih Pesawat</option>
                @foreach($pesawats as $pesawat)
                    <option value="{{ $pesawat->id }}" {{ $penerbangan->id_pesawat == $pesawat->id ? 'selected' : '' }}>
                        {{ $pesawat->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="maks_penumpang" class="form-label">Maksimum Penumpang</label>
            <input type="number" class="form-control" id="maks_penumpang" name="maks_penumpang" value="{{ old('maks_penumpang', $penerbangan->maks_penumpang) }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="harga_dewasa" class="form-label">Harga Tiket Dewasa</label>
            <input type="number" class="form-control" id="harga_dewasa" name="harga_dewasa" value="{{ old('harga_dewasa', $penerbangan->harga_dewasa) }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="harga_anak" class="form-label">Harga Tiket Anak</label>
            <input type="number" class="form-control" id="harga_anak" name="harga_anak" value="{{ old('harga_anak', $penerbangan->harga_anak) }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('penerbangan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
