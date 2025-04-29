@extends('admin.layouts.main.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-6">
            <h4>Tambah Maskapai</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success" id="notif">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.maskapai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama_maskapai" class="form-label">Nama Maskapai</label>
                    <input type="text" name="nama_maskapai" class="form-control" id="nama_maskapai" placeholder="Contoh: Garuda Indonesia" value="{{ old('nama_maskapai') }}" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Contoh: garuda-indonesia" value="{{ old('slug') }}" required>
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Logo Maskapai</label>
                    <input type="file" name="logo" class="form-control" id="logo" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.maskapai.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
