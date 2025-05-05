@extends('admin.layouts.main.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Bandara</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('bandara.create') }}" class="btn btn-primary mb-3">+ Tambah Bandara</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bandara</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bandaras as $index => $bandara)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bandara->nama_bandara }}</td>
                    <td>{{ $bandara->latitude }}</td>
                    <td>{{ $bandara->longitude }}</td>
                    <td>
                        <a href="{{ route('bandara.edit', $bandara->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('bandara.destroy', $bandara->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
