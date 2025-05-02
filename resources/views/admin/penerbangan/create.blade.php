@extends('admin.layouts.main.app')

@section('content')
<h2>Tambah Data Penerbangan</h2>

@if($errors->any())
    <div style="color:red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('penerbangan.store') }}">
    @csrf

    <label>Slug (unik):</label>
    <input type="text" name="slug" required><br><br>

    <label>Tanggal & Waktu Berangkat:</label>
    <input type="datetime-local" name="tanggal_berangkat" required><br><br>

    <label>Tanggal Tiba:</label>
    <input type="date" name="tanggal_tiba" required><br><br>

    <label>Jam Berangkat:</label>
    <input type="time" name="jam_berangkat" required><br><br>

    <label>Bandara Asal:</label>
    <select name="id_bandara_asal" required>
        <option value="">-- Pilih Bandara Asal --</option>
        @foreach($bandaras as $bandara)
            <option value="{{ $bandara->id }}">{{ $bandara->nama }}</option>
        @endforeach
    </select><br><br>

    <label>Bandara Tujuan:</label>
    <select name="id_bandara_tujuan" required>
        <option value="">-- Pilih Bandara Tujuan --</option>
        @foreach($bandaras as $bandara)
            <option value="{{ $bandara->id }}">{{ $bandara->nama }}</option>
        @endforeach
    </select><br><br>

    <label>Pesawat:</label>
    <select name="id_pesawat" required>
        <option value="">-- Pilih Pesawat --</option>
        @foreach($pesawats as $pesawat)
            <option value="{{ $pesawat->id }}">{{ $pesawat->nama }}</option>
        @endforeach
    </select><br><br>

    <label>Harga Dewasa (Rp):</label>
    <input type="number" name="harga_dewasa" min="0" required><br><br>

    <label>Harga Anak (Rp):</label>
    <input type="number" name="harga_anak" min="0" required><br><br>

    <label>Maksimal Penumpang:</label>
    <input type="number" name="maks_penumpang" min="1" required><br><br>

    <button type="submit">Simpan</button>
</form>
@endsection
