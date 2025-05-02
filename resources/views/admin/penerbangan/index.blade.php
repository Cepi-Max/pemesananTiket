@extends('admin.layouts.main.app')

@section('content')
<h2>Daftar Penerbangan</h2>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<a href="{{ route('penerbangan.create') }}">+ Tambah Penerbangan</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Slug</th>
            <th>Berangkat</th>
            <th>Tiba</th>
            <th>Jam</th>
            <th>Bandara Asal</th>
            <th>Bandara Tujuan</th>
            <th>Pesawat</th>
            <th>Harga Dewasa</th>
            <th>Harga Anak</th>
            <th>Kapasitas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($penerbangans as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->slug }}</td>
            <td>{{ $item->tanggal_berangkat }}</td>
            <td>{{ $item->tanggal_tiba }}</td>
            <td>{{ $item->jam_berangkat }}</td>
            <td>{{ $item->bandaraAsal->nama ?? '-' }}</td>
            <td>{{ $item->bandaraTujuan->nama ?? '-' }}</td>
            <td>{{ $item->pesawat->nama ?? '-' }}</td>
            <td>Rp {{ number_format($item->harga_dewasa, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->harga_anak, 0, ',', '.') }}</td>
            <td>{{ $item->maks_penumpang }}</td>
            <td>
                <a href="{{ route('penerbangan.edit', $item->id) }}">Edit</a> |
                <form action="{{ route('penerbangan.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

