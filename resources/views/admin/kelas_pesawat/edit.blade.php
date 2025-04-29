@extends('admin.layouts.main.app')

@section('content')
<div class="container-fluid py-4">

    <div class="row">
        <div class="col-lg-6">
            <h4>Edit Kelas Pesawat</h4>

            @if(session('success'))
                <div class="alert alert-success" id="notif">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('kelas_pesawat.update', $kelasPesawat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" value="{{ old('nama_kelas', $kelasPesawat->nama_kelas) }}" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug', $kelasPesawat->slug) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('kelas_pesawat.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</div>
@endsection
