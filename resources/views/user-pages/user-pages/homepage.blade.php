@extends('layouts.dashboard')

@section('title', 'Beranda - Tiket Pesawat')

@section('content')
    {{-- Hero --}}
    <section class="bg-[url('{{ asset('images/hero.png') }}')] bg-cover bg-center h-[50vh] text-white flex items-center">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-4xl font-bold">Cari dan Pesan Tiket Pesawat dengan Mudah</h2>
        </div>
    </section>

    {{-- Form --}}
    <section class="-mt-20 px-4 mb-20">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6 text-gray-800">
            <form action="{{ route('penerbangan.search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                    <input type="text" name="bandara_asal" id="bandara_asal" placeholder="Bandara Asal"
                        class="border p-3 rounded w-full pl-10" />
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="material-icons">flight_takeoff</i>
                    </span>
                    <div id="bandara-asal-results" class="absolute bg-white border rounded w-full mt-1 hidden"></div>
                </div>
                <div class="relative">
                    <input type="text" name="bandara_tujuan" id="bandara_tujuan" placeholder="Bandara Tujuan"
                        class="border p-3 rounded w-full pl-10" />
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="material-icons">flight_land</i>
                    </span>
                    <div id="bandara-tujuan-results" class="absolute bg-white border rounded w-full mt-1 hidden"></div>
                </div>
                <div class="relative">
                    <select name="namaKelas" id="namaKelas"
                        class="border p-3 rounded w-full pl-10 appearance-none focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled selected>Pilih Kelas</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none">
                        <i class="material-icons">flight_class</i>
                    </span>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 01.832.445l5 7a1 1 0 01-.832 1.555H5a1 1 0 01-.832-1.555l5-7A1 1 0 0110 3zm0 2.236L6.868 10h6.264L10 5.236z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="relative">
                    <input type="date" name="tanggal" class="border p-3 rounded w-full pl-10" />
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="material-icons">calendar_today</i>
                    </span>
                </div>
                <div class="relative">
                    <input type="number" name="jumlah_penumpang" value="1" placeholder="Jumlah Penumpang"
                        class="border p-3 rounded w-full pl-10" />
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="material-icons">people</i>
                    </span>
                </div>
                <button type="submit"
                    class="md:col-span-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded">
                    Cari Tiket
                </button>
            </form>
        </div>
    </section>

    <div class="space-y-6 max-w-4xl mx-auto">
        @foreach ($dashboardImages as $image)
            <!-- Card dalam layout horizontal -->
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <!-- Card Image 1 -->
                @if ($image->image1)
                    <div class="relative group flex-1">
                        <img src="{{ asset('images/' . $image->image1) }}"
                            class="w-full h-80  sm:h-48 object-cover rounded-lg shadow-lg transition-all duration-300 group-hover:scale-105"
                            alt="Promo Image 1">
                        <div
                            class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <span class="font-semibold text-xl">Promo Spesial 1</span>
                        </div>
                    </div>
                @endif
                <!-- Card Image 2 -->
                @if ($image->image2)
                    <div class="relative group flex-1">
                        <img src="{{ asset('images/' . $image->image2) }}"
                            class="w-full h-80  sm:h-48 object-cover rounded-lg shadow-lg transition-all duration-300 group-hover:scale-105"
                            alt="Promo Image 2">
                        <div
                            class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <span class="font-semibold text-xl">Promo Spesial 2</span>
                        </div>
                    </div>
                @endif
                <!-- Card Image 3 -->
                @if ($image->image3)
                    <div class="relative group flex-1">
                        <img src="{{ asset('images/' . $image->image3) }}"
                            class="w-full h-80 sm:h-48 object-cover rounded-lg shadow-lg transition-all duration-300 group-hover:scale-105"
                            alt="Promo Image 3">
                        <div
                            class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <span class="font-semibold text-xl">Promo Spesial 3</span>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <section class="py-10 my-10 bg-gray-50 bg-[url('{{ asset('images/hero.png') }}')] bg-cover bg-center">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Layout untuk dua div: Kata-kata Promo di sebelah kiri dan Card Promo di sebelah kanan -->
            <div class="flex flex-wrap justify-between space-y-6 sm:space-y-0">
                <!-- Bagian Kiri: Kata-kata Promo -->
                <div class="w-full sm:w-1/2">
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="material-icons text-yellow-500 text-4xl">local_offer</span>
                        <h2 class="text-3xl font-extrabold text-gray-50 tracking-tight">
                            Promo Terbaru Kami!
                        </h2>
                    </div>
                    <p
                        class="text-lg text-gray-600 leading-relaxed bg-blue-50 p-4 rounded-lg shadow-sm border-l-4 border-blue-500 mx-2">
                        Nikmati berbagai <span class="font-semibold text-blue-700">promo menarik</span> untuk perjalanan
                        Anda.
                        Dapatkan <span class="font-semibold text-blue-700">diskon eksklusif</span> dan
                        <span class="font-semibold text-blue-700">penawaran spesial</span> hanya di platform kami.<br>
                        <span class="text-blue-700 font-semibold">Jangan lewatkan kesempatan terbatas ini!</span>
                    </p>
                </div>

                <!-- Bagian Kanan: Card Promo -->
                <div class="w-full sm:w-1/2">
                    <!-- Slider horizontal -->
                    <div class="overflow-x-auto ">
                        <div
                            class="grid grid-flow-col auto-cols-[minmax(250px,_1fr)] gap-7 justify-center items-center py-4 mt-10">
                            @foreach ($promos as $promo)
                                <a href="{{ route('promo.detail', $promo->slug) }}"
                                    class="block p-6 min-w-[260px] bg-white rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 border border-gray-200  bg-[url('{{ asset('images/card.png') }}')] bg-cover bg-center">

                                    <div class="flex flex-col items-center space-y-3">
                                        <!-- Ikon Google Material -->
                                        <span class="material-icons text-gray-50 text-3xl">local_offer</span>

                                        <!-- Kode Promo -->
                                        <h3 class="text-xl font-bold text-center text-gray-50 ">
                                            {{ $promo->kode_promo }}
                                        </h3>

                                        <!-- Jenis Diskon -->
                                        @if ($promo->jumlah_persen)
                                            <p class="text-lg text-center text-green-600 font-semibold">
                                                Diskon: {{ $promo->jumlah_persen }}%
                                            </p>
                                        @elseif($promo->jumlah_rp)
                                            <p
                                                class="text-lg text-center bg-blue-100 p-2 rounded-md text-blue-600 font-semibold">
                                                Diskon: Rp{{ number_format($promo->jumlah_rp, 0, ',', '.') }}
                                            </p>
                                        @endif

                                        <!-- CTA kecil -->
                                        <span
                                            class="inline-block mt-2 text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                                            Lihat Detail
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>
        </div>
    </section>



    <section class="py-10 my-8 w-full">
        <div class="w-full">
            <div x-data="{
                translateX: 0,
                slider: null,
                scrolling: null,
                startAutoScroll() {
                    this.slider = this.$refs.slider;
            
                    this.scrolling = setInterval(() => {
                        this.translateX -= 1;
            
                        // reset tanpa animasi kalau udah sampai setengah
                        if (Math.abs(this.translateX) >= this.slider.scrollWidth / 2) {
                            this.translateX = 0;
                            this.slider.style.transition = 'none';
                            this.slider.style.transform = `translateX(${this.translateX}px)`;
            
                            // pakai next tick supaya animasi aktif lagi
                            requestAnimationFrame(() => {
                                this.slider.style.transition = 'transform 0.1s linear';
                            });
                        } else {
                            this.slider.style.transform = `translateX(${this.translateX}px)`;
                        }
                    }, 20);
                }
            }" x-init="startAutoScroll" class="overflow-hidden">
                <div class="flex gap-12 w-max items-center px-6" x-ref="slider"
                    style="transition: transform 0.1s linear">
                    <!-- DUA KALI -->
                    <template x-for="i in 5">
                        <div class="flex gap-12 items-center">
                            <img src="{{ asset('images/garuda.png') }}" class="h-10 object-contain" alt="Garuda" />
                            <img src="{{ asset('images/airasia.png') }}" class="h-10 object-contain" alt="AirAsia" />
                            <img src="{{ asset('images/batik.png') }}" class="h-10 object-contain" alt="Batik Air" />
                            <img src="{{ asset('images/citilink.png') }}" class="h-10 object-contain" alt="Citilink" />
                            <img src="{{ asset('images/qatar.png') }}" class="h-10 object-contain"
                                alt="Qatar Airways" />
                        </div>
                    </template>

                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan -->
    <section class=" py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-2xl font-semibold text-center mb-10">
                Kenapa Memilih Kami?
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="shadow-md p-5 rounded-md">
                    <div class="text-4xl text-blue-600 mb-2">🛫</div>
                    <h4 class="font-bold">Banyak Pilihan Maskapai</h4>
                    <p class="text-gray-600 text-sm mt-2 text-justify">
                        Kami bekerja sama dengan berbagai maskapai terkemuka, baik domestik maupun internasional,
                        untuk memastikan Anda memiliki fleksibilitas dan kenyamanan dalam memilih rute dan jadwal
                        penerbangan.
                    </p>
                </div>
                <div class="shadow-md p-5 rounded-md">
                    <div class="text-4xl text-blue-600 mb-2">💳</div>
                    <h4 class="font-bold">Pembayaran Mudah</h4>
                    <p class="text-gray-600 text-sm mt-2 text-justify">
                        Kami mendukung berbagai metode pembayaran seperti transfer bank, dompet digital (e-wallet),
                        kartu debit/kredit, serta metode lainnya yang aman dan cepat agar proses transaksi Anda lebih
                        praktis.
                    </p>
                </div>
                <div class="shadow-md p-5 rounded-md">
                    <div class="text-4xl text-blue-600 mb-2">📱</div>
                    <h4 class="font-bold">E-ticket Langsung</h4>
                    <p class="text-gray-600 text-sm mt-2 text-justify">
                        Setelah pembayaran berhasil, e-ticket akan langsung dikirim secara otomatis ke email dan WhatsApp
                        Anda,
                        sehingga Anda dapat langsung check-in tanpa harus menunggu lama atau repot mencetak tiket.
                    </p>
                </div>
            </div>
        </div>
    </section>





    <script>
        $(document).ready(function() {
            // Pencarian Bandara Asal
            $('#bandara_asal').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '{{ route('bandara.autocomplete') }}',
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            console.log(data); // debug dulu bro
                            if (data.length) {
                                response($.map(data, function(item) {
                                    return {
                                        labelNull: "",
                                        label: item.nama_bandara,
                                        kota: item.kota,
                                        value: item.nama_bandara,
                                        id: item.id,
                                    };
                                }));
                            } else {
                                response([{
                                    labelNull: "tidak terdeteksi bro 😢",
                                    label: "",
                                    kota: "",
                                    value: "",
                                    id: null,
                                }]);
                            }
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                    $('#bandara_asal').val(ui.item.value);
                    $('#bandara_asal_id').val(ui.item.id); // kalau mau simpan ID
                    return false;
                }
            }).autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li class='border-b p-2 hover:bg-gray-100 cursor-pointer'>")
                    .append(`
                <div class="flex flex-col">
                    <span class="font-semibold text-gray-800">${item.label}</span>
                    <span class="text-sm text-gray-500">${item.kota}</span>
                    <span class="italic text-gray-600">${item.labelNull}</span>
                </div>
            `)
                    .appendTo(ul);
            };


            // Pencarian Bandara Tujuan
            $('#bandara_tujuan').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '{{ route('bandara.autocomplete') }}',
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            console.log(data); // debug dulu bro
                            if (data.length) {
                                response($.map(data, function(item) {
                                    return {
                                        labelNull: "",
                                        label: item.nama_bandara,
                                        kota: item.kota,
                                        value: item.nama_bandara,
                                        id: item.id,
                                    };
                                }));
                            } else {
                                response([{
                                    labelNull: "tidak terdeteksi bro 😢",
                                    label: "",
                                    kota: "",
                                    value: "",
                                    id: null,
                                }]);
                            }
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                    $('#bandara_tujuan').val(ui.item.value);
                    $('#bandara_tujuan_id').val(ui.item.id); // kalau mau simpan ID
                    return false;
                }
            }).autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li class='border-b p-2 hover:bg-gray-100 cursor-pointer'>")
                    .append(`
                <div class="flex flex-col">
                    <span class="font-semibold text-gray-800">${item.label}</span>
                    <span class="text-sm text-gray-500">${item.kota}</span>
                    <span class="italic text-gray-600">${item.labelNull}</span>
                </div>
            `)
                    .appendTo(ul);
            };
        });

        // Untuk menampilkan hasil auto-complete
        $('#bandara_asal, #bandara_tujuan').on('focus', function() {
            $(this).autocomplete("search", ""); // Agar langsung menampilkan data jika input fokus
        });
    </script>

@endsection
