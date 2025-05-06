@extends('admin.layouts.main.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Data Penerbangan</h2>

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

    <form method="POST" action="{{ route('admin.penerbangan.store') }}">
        @csrf

        <div class="mb-3">
            <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat:</label>
            <input type="date" class="form-control" id="tanggal_berangkat" name="tanggal_berangkat" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_tiba" class="form-label">Tanggal Tiba:</label>
            <input type="date" class="form-control" id="tanggal_tiba" name="tanggal_tiba" required>
        </div>

        <div class="mb-3">
            <label for="jam_berangkat" class="form-label">Jam Berangkat:</label>
            <input type="time" class="form-control" id="jam_berangkat" name="jam_berangkat" required>
        </div>

        <div class="mb-3">
            <label for="id_bandara_asal" class="form-label">Bandara Asal:</label>
            <select class="form-select" id="id_bandara_asal" name="id_bandara_asal" required>
                <option value="">-- Pilih Bandara Asal --</option>
                @foreach($bandaras as $bandara)
                    <option value="{{ $bandara->id }}">{{ $bandara->nama_bandara }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_bandara_tujuan" class="form-label">Bandara Tujuan:</label>
            <select class="form-select" id="id_bandara_tujuan" name="id_bandara_tujuan" required>
                <option value="">-- Pilih Bandara Tujuan --</option>
                @foreach($bandaras as $bandara)
                    <option value="{{ $bandara->id }}">{{ $bandara->nama_bandara }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_pesawat" class="form-label">Pesawat:</label>
            <select class="form-select" id="id_pesawat" name="id_pesawat" required>
                <option value="">-- Pilih Pesawat --</option>
                @foreach($pesawats as $pesawat)
                    <option value="{{ $pesawat->id }}">{{ $pesawat->maskapai->nama_maskapai }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="harga_dewasa" class="form-label">Harga (Rp):</label>
            <input type="number" class="form-control" id="harga_dewasa" name="harga_dewasa" min="0" required>
        </div>

        <div class="mb-3">
            <label for="maks_penumpang" class="form-label">Maksimal Penumpang:</label>
            <input type="number" class="form-control" id="maks_penumpang" name="maks_penumpang" min="1" required>
        </div>

        <button type="submit" class="btn btn-dark">Simpan</button>
    </form>
</div>
@endsection
