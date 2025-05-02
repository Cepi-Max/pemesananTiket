@extends('admin.layouts.main.app')

@section('content')
<h2>Edit Promo</h2>

<form action="{{ route('promo.update', $promo->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Kode Promo:</label>
        <input type="text" name="kode_promo" value="{{ old('kode_promo', $promo->kode_promo) }}" required>
    </div>

    <div>
        <label>Slug (unique):</label>
        <input type="text" name="slug" value="{{ old('slug', $promo->slug) }}" required>
    </div>

    <div>
        <label>Diskon (%)</label>
        <input type="number" id="jumlah_persen" name="jumlah_%" min="0" max="100" step="0.01"
            value="{{ old('jumlah_%', $promo->{'jumlah_%'}) }}">
    </div>

    <div>
        <label>Diskon (Rp)</label>
        <input type="number" id="jumlah_rp" name="jumlah_rp" min="0" step="0.01"
            value="{{ old('jumlah_rp', $promo->jumlah_rp) }}">
    </div>

    <button type="submit">Perbarui</button>
</form>

<script>
    const persen = document.getElementById('jumlah_persen');
    const rupiah = document.getElementById('jumlah_rp');

    // Disable salah satu jika ada isinya saat halaman dimuat
    window.addEventListener('DOMContentLoaded', () => {
        if (persen.value) rupiah.disabled = true;
        if (rupiah.value) persen.disabled = true;
    });

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
