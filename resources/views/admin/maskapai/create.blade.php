@extends('admin.layouts.main.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Maskapai</h5>
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

                    {{-- Form --}}
                    <form action="{{ route('admin.maskapai.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_maskapai" class="form-label">Nama Maskapai</label>
                            <input type="text" name="nama_maskapai" class="form-control" id="nama_maskapai" placeholder="Contoh: Garuda Indonesia" value="{{ old('nama_maskapai') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Maskapai</label>
                            <input type="file" name="logo" class="form-control" id="logo" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.maskapai.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
