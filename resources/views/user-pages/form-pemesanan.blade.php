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
    <section>
        @if (session('success'))
            <div class="mb-6 bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong> Ada beberapa kesalahan saat mengisi form:
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pemesanan.submit') }}" method="POST"
            class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
            @csrf

            <!-- Info Penerbangan -->
            <div class="space-y-1 text-gray-800">
                <p>Harga Tiket: <strong>Rp {{ number_format($penerbangan->harga_dewasa) }}</strong></p>
                <p>Jumlah Penumpang: <strong>{{ $jumlahPenumpang }}</strong></p>
                <p class="text-lg font-bold">Total Harga: Rp
                    {{ number_format($penerbangan->harga_dewasa * $jumlahPenumpang) }}</p>
            </div>

            <!-- Data Pemesan -->
            <div class="border border-gray-200 rounded p-4 space-y-4">
                <h3 class="text-lg font-semibold">Data Pemesan</h3>

                <div class="flex items-center gap-6">
                    <label class="flex items-center">
                        <input type="radio" name="gender_pemesan" value="L" required
                            class="form-radio text-blue-600">
                        <span class="ml-2">Tuan</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="gender_pemesan" value="P" required
                            class="form-radio text-pink-500">
                        <span class="ml-2">Nyonya</span>
                    </label>
                </div>
                @error('gender_pemesan')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <input type="text" name="nama_pemesan" placeholder="Nama Lengkap" required
                            class="w-full p-3 border rounded">
                        @error('nama_pemesan')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="email" name="email_pemesan" placeholder="Email" required
                            class="w-full p-3 border rounded">
                        @error('email_pemesan')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="telp_pemesan" placeholder="No. Telepon" required
                            class="w-full p-3 border rounded">
                        @error('telp_pemesan')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data Penumpang -->
            @for ($i = 0; $i < $jumlahPenumpang; $i++)
                <div class="border border-gray-200 rounded p-4 space-y-4">
                    <h3 class="text-lg font-semibold">Data Penumpang {{ $i + 1 }}</h3>

                    <div class="flex items-center gap-6">
                        <label class="flex items-center">
                            <input type="radio" name="penumpang[{{ $i }}][gender]" value="L" required
                                class="form-radio text-blue-600">
                            <span class="ml-2">Tuan</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="penumpang[{{ $i }}][gender]" value="P" required
                                class="form-radio text-pink-500">
                            <span class="ml-2">Nyonya</span>
                        </label>
                    </div>
                    @error("penumpang.$i.gender")
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    <input type="text" name="penumpang[{{ $i }}][nama]"
                        placeholder="Nama Lengkap Penumpang {{ $i + 1 }}" required
                        class="w-full p-3 border rounded">
                    @error("penumpang.$i.nama")
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endfor

            <!-- Hidden Inputs -->
            <input type="hidden" name="penerbangan_id" value="{{ $penerbangan->id }}">
            <input type="hidden" name="jumlah_penumpang" value="{{ $jumlahPenumpang }}">

            <!-- Submit -->
            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition">
                    Pesan Tiket
                </button>
            </div>
        </form>

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
