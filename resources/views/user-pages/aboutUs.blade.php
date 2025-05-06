@extends('layouts.dashboard')

@section('title', 'Tentang Kami')

@section('content')
    {{-- Tambahkan Google Icons jika belum --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <section class="bg-white py-16">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-10">
                <div class="flex justify-center items-center gap-2 mb-4">
                    <span class="material-icons text-blue-600 text-3xl">info</span>
                    <h2
                        class="inline-block text-sm font-bold uppercase tracking-widest bg-blue-100 text-blue-800 px-4 py-1 rounded-full">
                        Tentang Kami
                    </h2>
                </div>
                <h1 class="text-4xl font-extrabold text-gray-900">Visi, Misi, dan Profil Perusahaan</h1>
                <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                    Kenali lebih dekat tujuan kami dan komitmen dalam melayani kebutuhan perjalanan Anda.
                </p>
            </div>

            <div class="text-gray-700 space-y-8 leading-relaxed max-w-4xl mx-auto">
                <div class="bg-blue-50 p-6 rounded-lg shadow-lg border-l-4 border-blue-600">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Visi</h3>
                    <p class="text-lg">
                        {!! $aboutUs->visi !!}
                    </p>
                </div>

                <div class="bg-green-50 p-6 rounded-lg shadow-lg border-l-4 border-green-600">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Misi</h3>
                    {!! $aboutUs->misi !!}
                </div>

                <div class="bg-yellow-50 p-6 rounded-lg shadow-lg border-l-4 border-yellow-600">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Profil Perusahaan</h3>
                    <p class="text-lg">
                        {!! $aboutUs->profil !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
