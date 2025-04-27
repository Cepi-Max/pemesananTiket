@extends('admin.layouts.main.app')

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.kota.create') }}" class="btn btn-primary my-3">+ Tambah Kota</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kota</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kota as $item)
                <tr>
                    <td>{{ $item->nama_kota }}</td>
                    <td>{{ $item->latitude }}</td>
                    <td>{{ $item->longitude }}</td>
                    <td>
                        <a href="{{ route('admin.kota.edit', $item->slug) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.kota.destroy', $item->slug) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus kota ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada data kota.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
