@extends('admin.layouts.main.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Judul dan Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Bandara</h4>
        <a href="{{ route('admin.bandara.create') }}" class="btn btn-dark">Tambah Bandara</a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Tabel Bandara --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Bandara</th>
                            <th>Nama Kota</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bandaras as $index => $bandara)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $bandara->nama_bandara }}</td>
                            <td>{{ $bandara->kota->nama_kota }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.bandara.edit', $bandara->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i>Edit
                                </a>
                                <form action="{{ route('admin.bandara.destroy', $bandara->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data bandara.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
