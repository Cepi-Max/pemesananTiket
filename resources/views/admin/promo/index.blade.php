@extends('admin.layouts.main.app')

@section('content')
<h2>Daftar Promo</h2>

<a href="{{ route('promo.create') }}">+ Tambah Promo</a>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table border="1">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Slug</th>
            <th>Diskon (%)</th>
            <th>Diskon (Rp)</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($promos as $promo)
        <tr>
            <td>{{ $promo->kode_promo }}</td>
            <td>{{ $promo->slug }}</td>
            <td>{{ $promo->{"jumlah_%"} ?? '-' }}</td>
            <td>{{ $promo->jumlah_rp ?? '-' }}</td>
            <td>
                <a href="{{ route('promo.edit', $promo->id) }}">Edit</a>
                <form action="{{ route('promo.destroy', $promo->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus promo?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
