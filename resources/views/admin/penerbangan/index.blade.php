@extends('admin.layouts.main.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Judul & Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Penerbangan</h4>
        <a href="{{ route('admin.penerbangan.create') }}" class="btn btn-dark">Tambah Penerbangan</a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
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
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penerbangans as $index => $item)
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
                            <td class="text-center">
                                <a href="{{ route('admin.penerbangan.edit', $item->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.penerbangan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted py-4">Belum ada data penerbangan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
