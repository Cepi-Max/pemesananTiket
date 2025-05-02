@extends('admin.layouts.main.app')

@section('content')
<h2>Tambah Promo</h2>

<form action="{{ route('promo.store') }}" method="POST">
    @csrf

    <div>
        <label>Kode Promo:</label>
        <input type="text" name="kode_promo" required>
    </div>

    <div>
        <label>Slug (unique):</label>
        <input type="text" name="slug" required>
    </div>

    <div>
        <label>Diskon (%)</label>
        <input type="number" id="jumlah_persen" name="jumlah_%" min="0" max="100" step="0.01">
    </div>

    <div>
        <label>Diskon (Rp)</label>
        <input type="number" id="jumlah_rp" name="jumlah_rp" min="0" step="0.01">
    </div>

    <button type="submit">Simpan</button>
</form>

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
