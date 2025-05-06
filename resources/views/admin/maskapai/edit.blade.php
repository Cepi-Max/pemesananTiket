@extends('admin.layouts.main.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Edit Maskapai</h5>
                </div>
                <div class="card-body">
                    {{-- Notifikasi sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success" id="notif">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tampilkan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form Edit --}}
                    <form action="{{ route('admin.maskapai.update', $maskapai->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_maskapai" class="form-label">Nama Maskapai</label>
                            <input type="text" name="nama_maskapai" class="form-control" id="nama_maskapai" value="{{ old('nama_maskapai', $maskapai->nama_maskapai) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Maskapai (Opsional)</label>
                            <input type="file" name="logo" class="form-control" id="logo" accept="image/*">
                            @if($maskapai->logo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/images/maskapai/' . $maskapai->logo) }}" alt="Logo Maskapai" width="120" class="img-thumbnail">
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-warning text-white">Perbarui</button>
                            <a href="{{ route('admin.maskapai.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
