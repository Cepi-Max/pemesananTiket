@extends('admin.layouts.main.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Promo</h2>

    <form action="{{ route('admin.promo.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="kode_promo" class="form-label">Kode Promo:</label>
            <input type="text" name="kode_promo" id="kode_promo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_persen" class="form-label">Diskon (%)</label>
            <input type="number" id="jumlah_persen" name="jumlah_%" min="0" max="100" step="0.01" class="form-control">
        </div>

        <div class="mb-3">
            <label for="jumlah_rp" class="form-label">Diskon (Rp)</label>
            <input type="number" id="jumlah_rp" name="jumlah_rp" min="0" step="0.01" class="form-control">
        </div>

        <button type="submit" class="btn btn-dark">Simpan</button>
    </form>
</div>

<script>
    const persen = document.getElementById('jumlah_persen');
    const rupiah = document.getElementById('jumlah_rp');

    persen.addEventListener('input', function () {
        if (persen.value) {
            rupiah.disabled = true;
        } else {
            rupiah.disabled = false;
        }
    });

    rupiah.addEventListener('input', function () {
        if (rupiah.value) {
            persen.disabled = true;
        } else {
            persen.disabled = false;
        }
    });
</script>
@endsection
