@extends('admin.layouts.main.app')

@section('content')
<div class="container-fluid py-4">

    <h4>Daftar Maskapai</h4>

    @if(session('success'))
        <div class="alert alert-success" id="notif">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('maskapai.create') }}" class="btn btn-success mb-3">Tambah Maskapai</a>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Maskapai</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Maskapai</th>
                        <th>Slug</th>
                        <th>Logo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maskapis as $maskapai)
                    <tr>
                        <td>{{ $maskapai->nama_maskapai }}</td>
                        <td>
                            @if($maskapai->logo)
                                <img src="{{ asset('storage/' . $maskapai->logo) }}" width="50" alt="Logo">
                            @else
                                <img src="{{ asset('storage/logos/default.jpg') }}" width="50" alt="Logo">
                            @endif
                        </td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
