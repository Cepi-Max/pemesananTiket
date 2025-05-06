@extends('admin.layouts.main.app')

@section('content')
<div class="container-fluid py-4">

 
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Daftar Kelas Penerbangan</h4>
            <a href="{{ route('admin.kelas_pesawat.create') }}" class="btn btn-dark">
                Tambah Kelas Penerbangan
            </a>
        </div>
        
        @if(session('success'))
            <div id="notif" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        {{-- Daftar Kelas --}}
        <div class="col-lg-12 mt-5">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Kelas Pesawat</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Slug</th>
                                    <th>Nama Kelas</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelasPesawats as $index => $kelas)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $kelas->slug }}</td>
                                        <td>{{ $kelas->nama_kelas }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.kelas_pesawat.edit', $kelas->id) }}" class="btn btn-sm btn-warning me-1">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.kelas_pesawat.destroy', $kelas->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
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
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada data kelas pesawat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection
