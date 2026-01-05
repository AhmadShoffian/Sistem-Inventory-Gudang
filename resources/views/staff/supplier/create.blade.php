@extends('layouts.staff')

{{-- Header --}}
@section('header')
    <div class="relative bg-lightBlue-600 md:pt-32 pb-44 pt-12">
        <div class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-16 px-4">
            <div>
                <h2 class="text-white text-2xl md:text-3xl uppercase font-bold tracking-tight">
                    Tambah Data Supplier
                </h2>
                <p class="mt-2 md:mt-3 text-sm md:text-base leading-relaxed text-white opacity-80">
                    Silakan isi data supplier yang ingin ditambahkan ke dalam sistem inventaris.
                </p>
            </div>
        </div>
    </div>
@endsection

{{-- Konten --}}
@section('staff-content')
    <div class="px-6 -mt-32">

        {{-- Flash error --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Card Form --}}
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
            <div class="rounded-t px-6 py-3 border-0 bg-blueGray-50">
                <h3 class="font-semibold text-base text-blueGray-700">Form Tambah Supplier</h3>
            </div>

            <div class="px-6 py-6">
                <form method="POST" action="{{ route('staff.supplier.store') }}">
                    @csrf

                    {{-- Nama Supplier --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-blueGray-600 mb-1">Nama Perusahaan</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border px-4 py-2 rounded text-sm focus:outline-none focus:ring-2 focus:ring-lightBlue-500"
                            required>
                    </div>
                    {{-- Alamat Supplier --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-blueGray-600 mb-1">Alamat</label>
                        <textarea name="alamat" rows="3"
                            class="w-full border px-4 py-2 rounded text-sm focus:outline-none focus:ring-2 focus:ring-lightBlue-500"
                            required>{{ old('alamat') }}</textarea>
                    </div>
                    {{-- Tombol --}}
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('staff.supplier.index') }}"
                            class="bg-blueGray-100 hover:bg-blueGray-200 text-blueGray-600 text-xs font-semibold px-4 py-2 rounded shadow transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-lightBlue-500 hover:bg-lightBlue-600 text-white font-bold text-xs px-6 py-2 rounded shadow transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection
