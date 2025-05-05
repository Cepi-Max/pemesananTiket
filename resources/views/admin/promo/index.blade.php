@extends('admin.layouts.main.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Promo</h2>
        <a href="{{ route('promo.create') }}" class="btn btn-dark">+ Tambah Promo</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
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
                                <a href="{{ route('promo.edit', $promo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('promo.destroy', $promo->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus promo?')">Hapus</button>
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
