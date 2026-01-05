@extends('layouts.public')

@section('content')
    {{-- Navbar --}}
    <x-navbars.index-navbar fixed />

    {{-- Header Section --}}
    <section class="header relative pt-16 items-center flex h-screen max-h-860-px">
        <div class="container mx-auto items-center flex flex-wrap">
            <div class="w-full md:w-8/12 lg:w-6/12 xl:w-6/12 px-4">
                <div class="pt-32 sm:pt-0">
                    <h2 class="font-semibold text-4xl text-blueGray-600">
                        SIMBARANG – Sistem Inventory Barang Institut Seni Indonesia Yogyakarta
                    </h2>
                    <p class="mt-4 text-lg leading-relaxed text-blueGray-500">
                        Aplikasi berbasis web untuk pengelolaan data barang habis pakai, barang tetap, dan laporan notice
                        pajak secara efisien di lingkungan Kampus Institut Seni Indonesia Yogyakarta.
                    </p>
                    <div class="mt-12">
                        <a role="button" aria-label="Permintaan Akun SIMBARANG" href="{{ route('request-akun.form') }}"
                            class="get-started text-white font-bold px-6 py-4 rounded outline-none focus:outline-none mr-1 mb-1 bg-lightBlue-500 active:bg-lightBlue-600 uppercase text-sm shadow hover:shadow-lg ease-linear transition-all duration-150">
                            Permintaan Akun
                        </a>
                        <a role="button" aria-label="Masuk ke Sistem SIMBARANG" href="{{ route('login') }}"
                            class="ml-1 text-white font-bold px-6 py-4 rounded outline-none focus:outline-none mr-1 mb-1 bg-blueGray-700 active:bg-blueGray-600 uppercase text-sm shadow hover:shadow-lg ease-linear transition-all duration-150">
                            Masuk Sistem
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <img class="hidden md:block absolute top-0 right-0 pt-16 w-6/12 max-h-860px object-contain"
            src="{{ asset('img/pattern_react.png') }}" alt="Hero Image" />
    </section>
    <div class="mb-20"></div>

    {{-- ABOUT --}}
    <section class="container mx-auto px-4 pb-32 pt-48">
        <div class="items-center flex flex-wrap">
            <div class="w-full md:w-5/12 ml-auto px-12 md:px-4">
                <div class="md:pr-12">
                    <div
                        class="text-blueGray-500 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-white">
                        <i class="fas fa-building text-xl"></i>
                    </div>
                    <div id="tentang-institut-seni-indonesia" class="h-0 scroll-mt-32"></div>
                    <h3 class="text-3xl font-semibold">Tentang Institut Seni Indonesia Yogyakarta</h3>
                    <p class="mt-4 text-lg leading-relaxed text-blueGray-500">
                        Institut Seni Indonesia Yogyakarta adalah lembaga pendidikan tinggi yang berfokus pada pengembangan
                        seni dan budaya. Sistem Inventory Barang Institut Seni Indonesia Yogyakarta dirancang untuk membantu
                        pengelolaan barang secara efisien di lingkungan kampus.
                    </p>
                    <ul class="list-none mt-6 space-y-3">
                        <li class="flex items-center">
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 bg-blueGray-100 rounded-full mr-3">
                                <i class="fas fa-shield-alt text-blueGray-500"></i>
                            </span>
                            <span class="text-blueGray-600 font-medium">POLRI – Pengesahan STNK, BPKB, dan identifikasi
                                kendaraan</span>
                        </li>
                        <li class="flex items-center">
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 bg-blueGray-100 rounded-full mr-3">
                                <i class="fas fa-briefcase-medical text-blueGray-500"></i>
                            </span>
                            <span class="text-blueGray-600 font-medium">Jasa Raharja – Asuransi kecelakaan lalu
                                lintas</span>
                        </li>
                        <li class="flex items-center">
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 bg-blueGray-100 rounded-full mr-3">
                                <i class="fas fa-landmark text-blueGray-500"></i>
                            </span>
                            <span class="text-blueGray-600 font-medium">UPT PPD – Pemungutan pajak kendaraan bermotor</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="w-full md:w-6/12 mr-auto px-4 pt-24 md:pt-0">
                <img alt="SAMSAT" class="max-w-full rounded-lg shadow-xl" src="{{ asset('img/uptppd.jpg') }}" />
            </div>
        </div>
    </section>


    {{-- FOOTER --}}
    <footer class="relative bg-blueGray-200 pt-8 pb-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap text-left lg:text-left">
                <div class="w-full lg:w-6/12 px-4">
                    <h4 class="text-2xl font-semibold text-blueGray-700">Kontak Kami</h4>
                    <div class="mt-4 text-sm text-blueGray-600 space-y-2">
                        <p>
                            <i class="fas fa-map-marker-alt mr-2 text-lightBlue-500"></i>
                            Jl. Parangtritis Km. 6,5, Glondong, Panggungharjo, Kec. Sewon, Kabupaten Bantul, Daerah Istimewa
                            Yogyakarta 55188
                        </p>
                        <p>
                            <i class="fab fa-whatsapp mr-2 text-green-500"></i>
                            <a href="https://wa.me/6281255825035" target="_blank" class="text-green-600 hover:underline">
                                0812-5582-5035
                            </a>
                        </p>
                        <p>
                            <i class="fas fa-clock mr-2 text-yellow-500"></i>
                            Senin - Sabtu, 08.00 - 16.00 WIB
                        </p>
                    </div>
                </div>
            </div>

            <hr class="my-6 border-blueGray-300" />

            <div class="flex flex-wrap items-center md:justify-between justify-center">
                <div class="w-full md:w-6/12 px-4 mx-auto text-center">
                    <div class="text-sm text-blueGray-500 font-semibold py-1">
                        &copy; {{ date('Y') }} <span class="font-semibold uppercase">SIMBARANG</span> – Institut Seni
                        Indonesia Yogyakarta
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
