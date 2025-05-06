@extends('layouts.dashboard')

@section('title', 'Beranda - Tiket Pesawat')

@section('content')
<div
    class="bg-gradient-to-br from-gray-100 via-white to-blue-50 min-h-screen flex items-center justify-center"
    >
    <div
    class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 border border-blue-300 mx-4"
    >
    <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">
    Pembayaran Anda
    </h2>

  <!-- Promo result -->
<p id="promo-result" class="text-sm mt-2 mb-3"></p>

<!-- Total Harga -->
<div id="total-harga-container"
    class="bg-blue-100 text-blue-800 rounded-lg px-5 py-4 text-center text-xl font-semibold shadow-sm mb-6">
    <span id="total-harga-label">Total Harga:</span>
    <br>
    <span id="total-harga-text" class="text-2xl font-bold">
        Rp {{ number_format($totalHarga, 0, ',', '.') }}
    </span>
</div>




    <form id="form-promo" class="space-y-4">
        @csrf
        <label class="block text-sm font-medium text-gray-700">Kode Promo</label>
        <div class="flex rounded-md shadow-sm">
            <input type="text" name="kode_promo" id="kode_promo" placeholder="Masukkan kode promo"
                class="flex-1 px-4 py-2 rounded-l-md border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200" />
            <input type="hidden" name="total_harga" id="total_harga" value="{{ $totalHarga }}">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition">
                Terapkan
            </button>
        </div>
    </form>
    
    <!-- Output promo -->
    <div id="promo-result" class="mt-4 text-green-600 font-semibold"></div>
    


    

    <!-- Divider -->
    <div class="my-6 border-t border-gray-200"></div>

    <form action="{{ route('bayar') }}" method="POST">
        @csrf
        <!-- Tombol Bayar -->
        <input type="hidden" name="kode_booking" value="{{ session('kode_booking') }}">
        <button
        type="submit"
        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-xl shadow-md transition duration-300 transform hover:scale-105"
        >
        Bayar Sekarang
        </button>
    </form>

    <!-- Note -->
    <p class="mt-4 text-xs text-gray-500 text-center">
    Dengan menekan tombol "Bayar", Anda menyetujui syarat & ketentuan.
    </p>
    </div>
    </div>

    
<script>
    $('#form-promo').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: "{{ route('cek.promo') }}",
        method: "POST",
        data: $(this).serialize(),
        success: function(response) {
            // Tampilkan pesan promo berhasil
            $('#promo-result').html(`
                <p class="text-green-700 font-semibold">Promo berhasil diterapkan! Potongan: Rp ${response.potongan.toLocaleString('id-ID')}</p>
            `);

            // Ubah label total harga jadi "Harga Sebelumnya"
            $('#total-harga-label').text("Harga Sebelumnya:");

            // Tambahkan info harga setelah diskon di bawahnya
            if (!$('#harga-setelah-promo').length) {
                $('#total-harga-container').after(`
                    <div id="harga-setelah-promo" class="mt-3 bg-green-100 text-green-800 rounded-lg px-5 py-4 text-center text-xl font-semibold shadow-sm mb-6">
                        Total Setelah Promo:
                        <span class='text-2xl font-bold'>
                            Rp ${response.harga_setelah_diskon.toLocaleString('id-ID')}
                        </span>
                    </div>
                `);
            } else {
                // Kalau sudah ada, tinggal update aja nilainya
                $('#harga-setelah-promo span').text("Rp " + response.harga_setelah_diskon.toLocaleString('id-ID'));
            }
        },
        error: function(xhr) {
            const msg = xhr.responseJSON?.message || 'Gagal menerapkan promo.';
            $('#promo-result').text(msg).css('color', 'red');
        },
    });
});

</script>

@endsection