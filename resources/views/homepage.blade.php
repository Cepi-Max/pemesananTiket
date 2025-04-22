<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tiket Pesawat | Cari & Pesan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>

<body class="bg-white text-gray-800 font-sans">

    {{-- Navbar --}}
    <header class="bg-blue-800 text-white shadow border-b-2 border-white-100">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-4">
            <h1 class="text-xl font-bold">
                Sohib<span class="text-orange-300">Travel</span>
            </h1>
            <nav class="flex gap-4">
                <a href="#"
                    class="flex items-center gap-2 px-3 py-2 rounded hover:bg-orange-300 hover:text-white transition">
                    <span class="material-icons text-sm">home</span> Home
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-3 py-2 rounded hover:bg-orange-300 hover:text-white transition">
                    <span class="material-icons text-sm">person</span> About Us
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-3 py-2 rounded hover:bg-orange-300 hover:text-white transition">
                    <span class="material-icons text-sm">search</span> Cek Pesanan
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-3 py-2 rounded hover:bg-orange-300 hover:text-white transition">
                    <span class="material-icons text-sm">login</span> Masuk
                </a>
            </nav>
        </div>
    </header>

    {{-- Hero --}}
    <section
        class="bg-[url('{{ asset('images/hero.png') }}')] bg-cover bg-center h-[50vh] text-white flex items-center">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-4xl font-bold">Cari dan Pesan Tiket Pesawat dengan Mudah</h2>
        </div>
    </section>

    {{-- Form --}}
    <section class="-mt-20 px-4 mb-20">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6 text-gray-800">
            <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                    <input type="text" placeholder="Bandara Asal" class="border p-3 rounded w-full pl-10" />
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="material-icons">flight_takeoff</i>
                    </span>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Bandara Tujuan" class="border p-3 rounded w-full pl-10" />
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="material-icons">flight_land</i>
                    </span>
                </div>
                <div class="relative">
                    <input type="date" class="border p-3 rounded w-full pl-10" />
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="material-icons">calendar_today</i>
                    </span>
                </div>
                <div class="relative">
                    <input type="number" placeholder="Jumlah Penumpang" class="border p-3 rounded w-full pl-10" />
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="material-icons">people</i>
                    </span>
                </div>
                <button class="md:col-span-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded">
                    Cari Tiket
                </button>
            </form>
        </div>
    </section>



    <section class="py-10 my-10">
        <div class="max-w-6xl mx-auto px-4">

            <div class="space-y-6">
                @foreach ($dashboardImages as $image)
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @if ($image->image1)
                            <img src="{{ asset('images/' . $image->image1) }}"
                                class="w-full h-64 object-cover rounded-lg shadow-md" alt="Banner Image 1">
                        @endif
                        @if ($image->image2)
                            <img src="{{ asset('images/' . $image->image2) }}"
                                class="w-full h-64 object-cover rounded-lg shadow-md" alt="Banner Image 2">
                        @endif
                        @if ($image->image3)
                            <img src="{{ asset('images/' . $image->image3) }}"
                                class="w-full h-64 object-cover rounded-lg shadow-md" alt="Banner Image 3">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    <section class="py-10 bg-gray-900 my-10  ">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row gap-8">
            <!-- Keterangan Galeri -->
            <div class="md:w-3/4 flex items-center">
                <div>
                    <h2 class="text-3xl font-bold mb-4 text-gray-50"> Sohib<span class="text-orange-300">Travel</span>
                    </h2>
                    <p class="text-gray-50">
                        Temukan berbagai destinasi menarik dari seluruh penjuru dunia yang bisa kamu kunjungi. Lihat
                        inspirasi perjalananmu dari galeri kami!
                    </p>
                </div>
            </div>

            <!-- Galeri Slider Vertikal -->
            <div class="md:w-1/4 relative h-[192px] overflow-hidden" x-data="{
                y: 0,
                startScroll() {
                    const wrapper = this.$refs.wrapper;
                    setInterval(() => {
                        this.y -= 1;
                        if (Math.abs(this.y) >= wrapper.scrollHeight / 2) {
                            this.y = 0;
                            wrapper.style.transition = 'none';
                            wrapper.style.transform = `translateY(${this.y}px)`;
                            requestAnimationFrame(() => {
                                wrapper.style.transition = 'transform 0.1s linear';
                            });
                        } else {
                            wrapper.style.transform = `translateY(${this.y}px)`;
                        }
                    }, 20);
                }
            }" x-init="startScroll">
                <div class="space-y-4" x-ref="wrapper" style="transition: transform 0.1s linear;">
                    @foreach ($galleries->concat($galleries) as $gallery)
                        <div class="h-48 w-full rounded-lg overflow-hidden shadow-lg">
                            <img src="{{ asset('images/' . $gallery->image) }}" class="w-full h-full object-cover"
                                alt="{{ $gallery->title }}">
                        </div>
                    @endforeach
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
                            <img src="{{ asset('images/citilink.png') }}" class="h-10 object-contain"
                                alt="Citilink" />
                            <img src="{{ asset('images/qatar.png') }}" class="h-10 object-contain"
                                alt="Qatar Airways" />
                        </div>
                    </template>

                </div>
            </div>
        </div>
    </section>


    <!-- Keunggulan -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-2xl font-semibold text-center mb-10">
                Kenapa Memilih Kami?
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="shadow-md p-5  rounded-md">
                    <div class="text-4xl text-blue-600 mb-2 ">🛫</div>
                    <h4 class="font-bold">Banyak Pilihan Maskapai</h4>
                    <p class="text-gray-600 text-sm mt-2">
                        Ratusan rute domestik & internasional.
                    </p>
                </div>
                <div class="shadow-md p-5 rounded-md">
                    <div class="text-4xl text-blue-600 mb-2">💳</div>
                    <h4 class="font-bold">Pembayaran Mudah</h4>
                    <p class="text-gray-600 text-sm mt-2">
                        Transfer bank, e-wallet, hingga kartu kredit.
                    </p>
                </div>
                <div class="shadow-md p-5  rounded-md">
                    <div class="text-4xl text-blue-600 mb-2">📱</div>
                    <h4 class="font-bold">E-ticket Langsung</h4>
                    <p class="text-gray-600 text-sm mt-2">
                        Langsung dikirim via email & WhatsApp.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <footer class="bg-blue-800 text-white py-10">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Brand -->
            <div>
                <h1 class="text-xl font-bold">
                    Sohib<span class="text-orange-300">Travel</span>
                </h1>
                <p class="text-sm leading-relaxed">
                    Solusi mudah dan cepat untuk perjalanan Anda ke seluruh dunia. Temukan penerbangan terbaik dengan
                    harga terjangkau.
                </p>
            </div>

            <!-- Link Cepat -->
            <div>
                <h5 class="text-xl font-bold mb-3">Link Cepat</h5>
                <ul class="text-sm space-y-2">
                    <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                    <li><a href="#" class="hover:underline">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:underline">Kontak</a></li>
                </ul>
            </div>

            <!-- Sosial Media -->
            <div>
                <h5 class="text-xl font-bold mb-3">Ikuti Kami</h5>
                <div class="flex space-x-4 items-center">
                    <a href="#" class="hover:text-gray-200 flex items-center space-x-1">
                        <span class="material-icons">facebook</span>
                        <span>Facebook</span>
                    </a>
                    <a href="#" class="hover:text-gray-200 flex items-center space-x-1">
                        <span class="material-icons">photo_camera</span>
                        <span>Instagram</span>
                    </a>
                    <a href="#" class="hover:text-gray-200 flex items-center space-x-1">
                        <span class="material-icons">alternate_email</span>
                        <span>Twitter</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center text-sm mt-8 border-t border-blue-500 pt-4">
            © 2025 SohibTravel.
        </div>
    </footer>
</body>

</html>
