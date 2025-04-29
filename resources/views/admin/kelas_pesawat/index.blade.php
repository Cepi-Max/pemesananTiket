@extends('admin.layouts.main.app')

@section('content')
<div class="container-fluid py-4">

    <div class="row">
        <div class="col-lg-6">
            <h4 class="mb-3">Tambah Kelas Pesawat</h4>

            @if(session('success'))
                <div id="notif" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('kelas_pesawat.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" placeholder="Contoh: Ekonomi" required>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Contoh: ekonomi" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>

        <div class="col-lg-12 mt-5">
            <h4>Daftar Kelas Pesawat</h4>
            <table class="table table-bordered table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Slug</th>
                        <th>Nama Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelasPesawats as $index => $kelas)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kelas->slug }}</td>
                            <td>{{ $kelas->nama_kelas }}</td>
                            <td>
                                <a href="{{ route('kelas_pesawat.edit', $kelas->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('kelas_pesawat.destroy', $kelas->id) }}" method="POST" class="d-inline" id="form-delete-{{ $kelas->slug }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $kelas->slug }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Belum ada data kelas pesawat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
