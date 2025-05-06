@extends('admin.layouts.main.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Maskapai</h4>
        <a href="{{ route('admin.maskapai.create') }}" class="btn btn-dark">
            Tambah Maskapai
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="notif">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Maskapai</th>
                            <th>Logo</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($maskapis as $maskapai)
                        <tr>
                            <td>{{ $maskapai->nama_maskapai }}</td>
                            <td>
                                <img src="{{ $maskapai->logo ? asset('storage/images/maskapai/' . $maskapai->logo) : asset('storage/logos/default.jpg') }}" alt="Logo" width="50" class="img-thumbnail">
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.maskapai.edit', $maskapai->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.maskapai.destroy', $maskapai->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus maskapai ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada data maskapai.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
