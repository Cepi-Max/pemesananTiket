@extends('layouts.dashboard')

@section('title', 'Beranda - Tiket Pesawat')

@section('content')
    {{-- Hero --}}
    {{-- <section class="bg-[url('{{ asset('images/hero.png') }}')] bg-cover bg-center h-[50vh] text-white flex items-center">
        {{-- <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-4xl font-bold">Cari dan Pesan Tiket Pesawat dengan Mudah</h2>
        </div> --}}


    {{-- Form --}}
    <section class="py-16 px-4  bg-[url('{{ asset('images/hero.png') }}')] bg-no-repeat bg-top bg-[length:100%_50%]">

        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Form Header -->
            <div class="bg-blue-600 p-6 text-white">
                <h2 class="text-2xl font-bold">Cari Penerbangan</h2>
                <p class="text-blue-100 mt-1">Temukan penerbangan terbaik untuk perjalanan Anda</p>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form action="{{ route('penerbangan.search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Origin Airport -->
                    <div class="relative group">
                        <label for="bandara_asal" class="block text-sm font-medium text-gray-700 mb-1">Bandara Asal</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-500">
                                <i class="material-icons">flight_takeoff</i>
                            </span>
                            <input type="text" name="bandara_asal" id="bandara_asal"
                                placeholder="Masukkan kota atau nama bandara"
                                class="border border-gray-300 p-3 rounded-lg w-full pl-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" />
                            <div id="bandara-asal-results"
                                class="absolute bg-white border rounded-lg w-full mt-1 shadow-lg z-10 hidden"></div>
                        </div>
                    </div>

                    <!-- Destination Airport -->
                    <div class="relative group">
                        <label for="bandara_tujuan" class="block text-sm font-medium text-gray-700 mb-1">Bandara
                            Tujuan</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-500">
                                <i class="material-icons">flight_land</i>
                            </span>
                            <input type="text" name="bandara_tujuan" id="bandara_tujuan"
                                placeholder="Masukkan kota atau nama bandara"
                                class="border border-gray-300 p-3 rounded-lg w-full pl-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" />
                            <div id="bandara-tujuan-results"
                                class="absolute bg-white border rounded-lg w-full mt-1 shadow-lg z-10 hidden"></div>
                        </div>
                    </div>

                    <!-- Class Selection -->
                    <div class="relative group">
                        <label for="namaKelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas
                            Penerbangan</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-500">
                                <i class="material-icons">airline_seat_recline_normal</i>
                            </span>
                            <select name="namaKelas" id="namaKelas"
                                class="border border-gray-300 p-3 rounded-lg w-full pl-10 appearance-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <option value="" disabled selected>Pilih Kelas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Date Selection -->
                    <div class="relative group">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                            Keberangkatan</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-500">
                                <i class="material-icons">calendar_today</i>
                            </span>
                            <input type="date" name="tanggal" id="tanggal"
                                class="border border-gray-300 p-3 rounded-lg w-full pl-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" />
                        </div>
                    </div>

                    <!-- Passenger Count -->
                    <div class="relative group">
                        <label for="jumlah_penumpang" class="block text-sm font-medium text-gray-700 mb-1">Jumlah
                            Penumpang</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-500">
                                <i class="material-icons">people</i>
                            </span>
                            <input type="number" name="jumlah_penumpang" id="jumlah_penumpang" min="1"
                                value="1" placeholder="Jumlah Penumpang"
                                class="border border-gray-300 p-3 rounded-lg w-full pl-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" />
                        </div>
                    </div>
                    <div class="relative group">
                        <div class="md:col-span-2 mt-4">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 focus:bg-blue-800 text-white font-bold py-4 px-6 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-md">
                                <i class="material-icons">search</i>
                                Cari Tiket
                            </button>
                        </div>
                    </div>
                    <!-- Empty space for layout balance on mobile -->

                    <div class="hidden md:block"></div>

                    <!-- Submit Button -->

                </form>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto">
        <div class="relative overflow-hidden">
            <!-- Carousel Navigation Buttons -->
            <button
                class="absolute top-1/2 left-2 z-10 -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-90 w-10 h-10 rounded-full flex items-center justify-center shadow-md transition-all duration-300">❮</button>
            <button
                class="absolute top-1/2 right-2 z-10 -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-90 w-10 h-10 rounded-full flex items-center justify-center shadow-md transition-all duration-300">❯</button>

            <!-- Carousel Items -->
            <div class="flex transition-transform duration-500 ease-in-out">
                @foreach ($dashboardImages as $image)
                    @if ($image->image1)
                        <div class="min-w-full">
                            <div class="relative group">
                                <img src="{{ asset('images/' . $image->image1) }}"
                                    class="w-full h-80 object-cover rounded-lg shadow-lg" alt="Promo Image 1">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-white text-2xl font-semibold">Promo Spesial 1</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($image->image2)
                        <div class="min-w-full">
                            <div class="relative group">
                                <img src="{{ asset('images/' . $image->image2) }}"
                                    class="w-full h-80 object-cover rounded-lg shadow-lg" alt="Promo Image 2">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-white text-2xl font-semibold">Promo Spesial 2</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($image->image3)
                        <div class="min-w-full">
                            <div class="relative group">
                                <img src="{{ asset('images/' . $image->image3) }}"
                                    class="w-full h-80 object-cover rounded-lg shadow-lg" alt="Promo Image 3">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-white text-2xl font-semibold">Promo Spesial 3</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Carousel Dots -->
            <div class="flex justify-center mt-3">
                @php
                    $dotCount = 0;
                    foreach ($dashboardImages as $image) {
                        if ($image->image1) {
                            $dotCount++;
                        }
                        if ($image->image2) {
                            $dotCount++;
                        }
                        if ($image->image3) {
                            $dotCount++;
                        }
                    }
                @endphp

                @for ($i = 0; $i < $dotCount; $i++)
                    <div
                        class="w-3 h-3 mx-1 rounded-full cursor-pointer transition-colors duration-300 {{ $i == 0 ? 'bg-gray-700' : 'bg-gray-300' }}">
                    </div>
                @endfor
            </div>
        </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Carousel elements
            const carousel = document.querySelector('.flex.transition-transform');
            const items = carousel.querySelectorAll('.min-w-full');
            const dots = document.querySelectorAll('.flex.justify-center .w-3');
            const prevBtn = document.querySelector('.left-2');
            const nextBtn = document.querySelector('.right-2');

            // Configuration
            const autoplayInterval = 5000; // ms between slides
            let currentIndex = 0;
            let autoplayTimer;

            // Initialize carousel
            updateCarousel();
            startAutoplay();

            // Event listeners
            prevBtn.addEventListener('click', showPrevSlide);
            nextBtn.addEventListener('click', showNextSlide);

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel();
                    resetAutoplay();
                });
            });

            // Functions
            function updateCarousel() {
                // Update carousel position
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;

                // Update active dot
                dots.forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.classList.remove('bg-gray-300');
                        dot.classList.add('bg-gray-700');
                    } else {
                        dot.classList.remove('bg-gray-700');
                        dot.classList.add('bg-gray-300');
                    }
                });
            }

            function showNextSlide() {
                currentIndex = (currentIndex + 1) % items.length;
                updateCarousel();
                resetAutoplay();
            }

            function showPrevSlide() {
                currentIndex = (currentIndex - 1 + items.length) % items.length;
                updateCarousel();
                resetAutoplay();
            }

            function startAutoplay() {
                autoplayTimer = setInterval(showNextSlide, autoplayInterval);
            }

            function resetAutoplay() {
                clearInterval(autoplayTimer);
                startAutoplay();
            }
        });
    </script>

@endsection