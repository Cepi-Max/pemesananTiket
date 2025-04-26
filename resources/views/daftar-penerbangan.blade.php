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
        <h2 class="text-2xl font-bold mb-4">Hasil Pencarian</h2>

        @if($penerbangan->count())
            <div class="grid gap-4">
                @foreach($penerbangan as $item)
                    <div class="border p-4 rounded shadow">
                        <h3 class="text-xl font-semibold">{{ $item->bandaraAsal->nama_bandara }} ➔ {{ $item->bandaraTujuan->nama_bandara }}</h3>
                        <p>Kota Asal: {{ $item->bandaraAsal->kota->nama_kota }}</p>
                        <p>Kota Tujuan: {{ $item->bandaraTujuan->kota->nama_kota }}</p>
                        <p>Tanggal Berangkat: {{ $item->tanggal_berangkat }}</p>
                        <p>Harga: Rp {{ number_format($item->harga_dewasa) }}</p>
                        <p>Sisa Kursi: {{ $item->maks_penumpang }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Tidak ada penerbangan yang sesuai bro 😢</p>
        @endif

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
