@extends('admin.layouts.main.app')

@section('content')
<div class="container-fluid py-4">

    <div class="row">
        <div class="col-lg-6">
            <h4>Tambah Kelas Pesawat</h4>

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

            <form action="{{ route('kelas_pesawat.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" placeholder="Contoh: Ekonomi" value="{{ old('nama_kelas') }}" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Contoh: ekonomi" value="{{ old('slug') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kelas_pesawat.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>
@endsection
