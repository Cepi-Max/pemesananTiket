@extends('admin.layouts.main.app')

@section('content')
<div class="container mt-4">
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

    <form action="{{ route('admin.penerbangan.update', $penerbangan->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
            <input type="date" class="form-control" id="tanggal_berangkat" name="tanggal_berangkat" value="{{ old('tanggal_berangkat', \Carbon\Carbon::parse($penerbangan->tanggal_berangkat)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_tiba" class="form-label">Tanggal Tiba</label>
            <input type="date" class="form-control" id="tanggal_tiba" name="tanggal_tiba" value="{{ old('tanggal_tiba', \Carbon\Carbon::parse($penerbangan->tanggal_tiba)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="jam_berangkat" class="form-label">Jam Berangkat :</label>
            <input type="time" class="form-control" id="jam_berangkat" name="jam_berangkat" value="{{ old('jam_berangkat', \Carbon\Carbon::parse($penerbangan->jam_berangkat)->format('H:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="id_bandara_asal" class="form-label">Bandara Asal</label>
            <select class="form-select" id="id_bandara_asal" name="id_bandara_asal" required>
                <option value="">Pilih Bandara Asal</option>
                @foreach($bandaras as $bandara)
                    <option value="{{ $bandara->id }}" {{ $penerbangan->id_bandara_asal == $bandara->id ? 'selected' : '' }}>
                        {{ $bandara->nama_bandara }}
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
                        {{ $bandara->nama_bandara }}
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
                        {{ $pesawat->maskapai->nama_maskapai }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="maks_penumpang" class="form-label">Maksimum Penumpang</label>
            <input type="decimal" class="form-control" id="maks_penumpang" name="maks_penumpang" value="{{ old('maks_penumpang', $penerbangan->maks_penumpang) }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="harga_dewasa" class="form-label">Harga (Rp)</label>
            <input type="decimal" class="form-control" id="harga_dewasa" name="harga_dewasa" value="{{ old('harga_dewasa', $penerbangan->harga_dewasa) }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
        <a href="{{ route('admin.penerbangan.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>
@endsection
