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

    <!-- Navbar -->
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

    <!-- Main Content with Sidebar -->
    <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Sidebar Filter -->
        <aside class="md:col-span-1 space-y-6 p-4 bg-white rounded-xl shadow">
            <h2 class="text-2xl font-bold text-gray-800 border-b pb-2 flex items-center gap-2">
                <span class="material-icons text-blue-600">filter_alt</span>
                Filter
            </h2>

            <form action="{{ route('penerbangan.search') }}" method="GET" class="space-y-6">

                <!-- Bandara Asal -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="material-icons text-blue-500">flight_takeoff</span>
                        Bandara Asal
                    </h3>
                    <div class="grid grid-cols-1 gap-2">
                        @foreach ($bandaraList as $bandara)
                            <label class="flex items-center gap-2 text-sm text-gray-600">
                                <input type="checkbox" name="bandara_asal[]" value="{{ $bandara->id }}"
                                    {{ in_array($bandara->id, request('bandara_asal', [])) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                {{ $bandara->nama_bandara }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Bandara Tujuan -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="material-icons text-blue-500">flight_land</span>
                        Bandara Tujuan
                    </h3>
                    <div class="grid grid-cols-1 gap-2">
                        @foreach ($bandaraList as $bandara)
                            <label class="flex items-center gap-2 text-sm text-gray-600">
                                <input type="checkbox" name="bandara_tujuan[]" value="{{ $bandara->id }}"
                                    {{ in_array($bandara->id, request('bandara_tujuan', [])) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                {{ $bandara->nama_bandara }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Maskapai -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="material-icons text-blue-500">airplanemode_active</span>
                        Maskapai
                    </h3>
                    <div class="grid grid-cols-1 gap-2">
                        @foreach ($maskapaiList as $maskapai)
                            <label class="flex items-center gap-2 text-sm text-gray-600">
                                <input type="checkbox" name="maskapai_id[]" value="{{ $maskapai->id }}"
                                    {{ in_array($maskapai->id, request('maskapai_id', [])) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                {{ $maskapai->nama_maskapai }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Kelas -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="material-icons text-blue-500">event_seat</span>
                        Kelas
                    </h3>
                    <div class="flex flex-col gap-2">
                        @foreach ($kelasList as $kelas)
                            <label class="flex items-center gap-2 text-sm text-gray-600">
                                <input type="checkbox" name="kelas[]" value="{{ $kelas }}"
                                    {{ is_array(request('kelas')) && in_array($kelas, request('kelas')) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="capitalize">{{ $kelas }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2">
                        <span class="material-icons text-white">search</span>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </aside>








        <!-- Tiket List -->
        <section class="md:col-span-3">
            <h1 class="text-3xl font-bold mb-6">Daftar Tiket Penerbangan</h1>
            @foreach ($penerbangan as $item)
                <div class="bg-white border rounded-xl shadow-sm p-4 mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-20 h-20 rounded-full bg-gray-50 flex items-center justify-center overflow-hidden border-2 border-blue-400">
                            <img src="{{ asset('images/' . $item->pesawat->maskapai->logo) }}"
                                alt="Logo {{ $item->pesawat->maskapai->nama_maskapai }}"
                                class="w-full h-auto object-contain">
                        </div>
                        <div>
                            <h2 class="text-lg text-gray-900 font-bold">{{ $item->pesawat->maskapai->nama_maskapai }}
                            </h2>
                            <p class="text-sm text-gray-800">{{ $item->bandaraAsal->nama_bandara }} —
                                {{ $item->bandaraTujuan->nama_bandara }}</p>
                            <div class="mt-1 text-sm text-gray-700 space-y-0.5">
                                <p>Tanggal Berangkat: <span
                                        class="font-medium text-green-500 bg-green-100 rounded-lg px-2">{{ $item->tanggal_berangkat }}</span>
                                    <span
                                        class="font-medium mx-1 text-green-500 bg-green-100 rounded-lg px-2">{{ $item->jam_berangkat }}</span>
                                </p>
                                <p>Kelas: <span
                                        class="font-medium text-blue-500 bg-blue-100 rounded-lg px-2">{{ $item->pesawat->kelas->nama_kelas }}</span>
                                </p>
                                <p>Sisa Kursi: <span
                                        class="font-medium text-yellow-500 bg-yellow-100 rounded-lg px-2">{{ $item->maks_penumpang }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-semibold text-red-500">Rp
                            {{ number_format($item->harga_dewasa, 0, ',', '.') }}</p>
                        <a href="{{ route('pemesanan.form', ['slug' => $item->slug, 'jumlah_penumpang' => request('jumlah_penumpang')]) }}"
                            class="inline-block mt-2 px-4 py-2 text-blue-800 text-sm rounded flex items-center gap-1">
                            Pilih Tiket
                            <span class="material-icons text-base">arrow_forward</span>
                        </a>


                    </div>
                </div>
            @endforeach
            <div class="mt-6">
                {{ $penerbangan->links() }}
            </div>

        </section>


    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white py-10">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <h1 class="text-xl font-bold">Sohib<span class="text-orange-300">Travel</span></h1>
                <p class="text-sm leading-relaxed">Solusi mudah dan cepat untuk perjalanan Anda ke seluruh dunia.
                    Temukan penerbangan terbaik dengan harga terjangkau.</p>
            </div>
            <div>
                <h5 class="text-xl font-bold mb-3">Link Cepat</h5>
                <ul class="text-sm space-y-2">
                    <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                    <li><a href="#" class="hover:underline">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:underline">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-xl font-bold mb-3">Ikuti Kami</h5>
                <div class="flex space-x-4 items-center">
                    <a href="#" class="hover:text-gray-200 flex items-center space-x-1">
                        <span class="material-icons">facebook</span><span>Facebook</span>
                    </a>
                    <a href="#" class="hover:text-gray-200 flex items-center space-x-1">
                        <span class="material-icons">photo_camera</span><span>Instagram</span>
                    </a>
                    <a href="#" class="hover:text-gray-200 flex items-center space-x-1">
                        <span class="material-icons">alternate_email</span><span>Twitter</span>
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
