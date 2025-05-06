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

            <form action="{{ route('admin.kelas_pesawat.update', $kelasPesawat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" value="{{ old('nama_kelas', $kelasPesawat->nama_kelas) }}" required>
                </div>

                <button type="submit" class="btn btn-dark">Update</button>
                <a href="{{ route('admin.kelas_pesawat.index') }}" class="btn btn-danger">Kembali</a>
            </form>
        </div>
    </div>

</div>
@endsection
