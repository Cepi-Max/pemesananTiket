@extends('admin.layouts.main.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Penerbangan</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('penerbangan.create') }}" class="btn btn-dark">+ Tambah Penerbangan</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
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
                                <a href="{{ route('penerbangan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('penerbangan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
