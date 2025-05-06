@extends('layouts.dashboard')

@section('content')
    <div class="max-w-6xl mx-auto my-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom 1-2: Detail Promo -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Card Promo Utama -->
            <div
                class="transition transform hover:scale-105 border border-yellow-500 
                bg-gradient-to-br from-gray-800 via-gray-900 to-black hover:shadow-yellow-500/50 p-6 rounded-2xl shadow-xl border border-gray-200 min-h-[360px] bg-[url('{{ asset('images/card.png') }}')] bg-cover bg-center flex flex-col justify-center">
                <h2 class="text-3xl font-extrabold text-yellow-400 mb-4 text-center">{{ $promo->kode_promo }}</h2>

                <div class="text-center">
                    @if ($promo->jumlah_persen)
                        <p class="text-5xl font-extrabold text-yellow-400 mb-2">{{ $promo->jumlah_persen }}%</p>
                        <p class="text-sm text-gray-100">Diskon dari total harga tiket</p>
                    @elseif($promo->jumlah_rp)
                        <p class="text-4xl font-extrabold text-yellow-400 mb-2 bg-green-100 p-2 rounded-md inline-block">
                            Rp{{ number_format($promo->jumlah_rp, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-100">Potongan langsung</p>
                    @endif
                </div>
            </div>


            <!-- Penjelasan Promo -->
            <div class="bg-white p-6 rounded-xl shadow-sm text-gray-700 leading-relaxed space-y-4">
                <p class="flex items-start gap-2">
                    <span class="material-icons text-blue-500">local_offer</span>
                    <span>
                        Nikmati berbagai promo menarik yang kami tawarkan untuk perjalanan Anda! Promo ini berlaku untuk
                        semua
                        rute penerbangan yang tersedia di sistem kami dan dapat digunakan selama masa berlaku promo masih
                        aktif.
                    </span>
                </p>

                <p class="flex items-start gap-2">
                    <span class="material-icons text-green-500">verified</span>
                    <span>
                        Pastikan Anda memasukkan kode promo saat melakukan pemesanan tiket agar diskon langsung diterapkan.
                        Promo tidak dapat digabungkan dengan penawaran lainnya dan hanya berlaku untuk pembelian online
                        melalui
                        website ini.
                    </span>
                </p>

                <p class="flex items-start gap-2">
                    <span class="material-icons text-purple-500">info</span>
                    <span>
                        Jumlah diskon dapat bervariasi tergantung jenis promo yang tersedia—baik berupa potongan harga tetap
                        maupun
                        persentase dari total pembelian. Detail lengkap bisa Anda lihat di masing-masing halaman promo.
                    </span>
                </p>

                <p class="flex items-start gap-2">
                    <span class="material-icons text-orange-500">schedule</span>
                    <span>
                        Kami menyarankan untuk selalu mengecek masa berlaku promo sebelum melakukan pemesanan agar tidak
                        terlewat.
                        Promo-promo baru akan terus kami tambahkan secara berkala!
                    </span>
                </p>
            </div>

        </div>

        <!-- Kolom 3: Promo Lainnya -->
        <div>
            <div class="text-center">
                <p class="flex items-start gap-2 my-2 ">
                    <span class="material-icons text-blue-500">local_offer</span>
                    <span class="text-xl font-extrabold">
                        Promo Lainnya
                    </span>
                </p>
            </div>
            <div class="space-y-6">
                @foreach ($promos as $item)
                    @if ($item->id !== $promo->id)
                    <a href="{{ route('promo.detail', $promo->slug) }}"
                        class="block p-6 min-w-[260px] rounded-lg shadow-xl transition transform hover:scale-105 border border-yellow-500 
                           bg-gradient-to-br from-gray-800 via-gray-900 to-black hover:shadow-yellow-500/50">

                        <div class="flex flex-col items-center space-y-3">
                            <!-- Ikon Google Material -->
                            <span class="material-icons text-yellow-400 text-4xl">local_offer</span>

                            <!-- Kode Promo -->
                            <h3 class="text-2xl font-bold text-center text-yellow-400">
                                {{ $promo->kode_promo }}
                            </h3>

                            <!-- Jenis Diskon -->
                            @if ($promo->jumlah_persen)
                                <p class="text-lg text-center text-green-400 font-semibold">
                                    Diskon: {{ $promo->jumlah_persen }}%
                                </p>
                            @else
                                <p
                                    class="text-lg text-center bg-yellow-100/20 text-yellow-300 px-3 py-2 rounded-md font-semibold">
                                    Diskon: Rp{{ number_format($promo->jumlah_rp, 0, ',', '.') }}
                                </p>
                            @endif

                            <!-- CTA kecil -->
                            <span
                                class="inline-block mt-2 text-sm bg-yellow-100/20 text-yellow-300 px-4 py-1 rounded-full font-medium">
                                Lihat Detail
                            </span>
                        </div>
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
