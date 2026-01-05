@extends('layouts.staff')

{{-- Header --}}
@section('header')
    <div class="relative bg-lightBlue-600 md:pt-32 pb-44 pt-12">
        <div class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-16 px-4">
            <div>
                <h2 class="text-white text-2xl md:text-3xl uppercase font-bold tracking-tight">
                    Tambah Barang
                </h2>
                <p class="mt-2 md:mt-3 text-sm md:text-base leading-relaxed text-white opacity-80">
                    Silakan isi data barang yang ingin ditambahkan ke dalam sistem inventaris.
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
                <h3 class="font-semibold text-base text-blueGray-700">Form Tambah Barang</h3>
            </div>

            <div class="px-6 py-6">
                <form method="POST" action="{{ route('staff.barang.store') }}" enctype="multipart/form-data" autocomplete="on">
                    @csrf

                    {{-- Nama Barang --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-blueGray-600 mb-1">Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                            class="w-full border px-4 py-2 rounded text-sm focus:outline-none focus:ring-2 focus:ring-lightBlue-500"
                            required>
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-blueGray-600 mb-1">Kategori</label>
                        <select name="kategori_id"
                            class="w-full border px-4 py-2 rounded text-sm focus:ring-2 focus:ring-lightBlue-500" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jumlah --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-blueGray-600 mb-1">Jumlah</label>
                        <input type="number" name="jumlah" min="1" value="{{ old('jumlah') }}"
                            class="w-full border px-4 py-2 rounded text-sm focus:ring-2 focus:ring-lightBlue-500" required>
                    </div>

                    {{-- Satuan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-blueGray-600 mb-1">Satuan</label>
                        <select name="satuan_id"
                            class="w-full border px-4 py-2 rounded text-sm focus:ring-2 focus:ring-lightBlue-500" required>
                            <option value="">-- Pilih Satuan --</option>
                            @foreach ($satuans as $satuan)
                                <option value="{{ $satuan->id }}" {{ old('satuan_id') == $satuan->id ? 'selected' : '' }}>
                                    {{ $satuan->nama_satuan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Lokasi --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-blueGray-600 mb-1">Lokasi</label>
                        <select name="lokasi_id"
                            class="w-full border px-4 py-2 rounded text-sm focus:ring-2 focus:ring-lightBlue-500" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach ($lokasis as $lokasi)
                                <option value="{{ $lokasi->id }}" {{ old('lokasi_id') == $lokasi->id ? 'selected' : '' }}>
                                    {{ $lokasi->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                     <div class="mb-4">
                        <label class="block text-sm font-medium text-blueGray-600 mb-1">Gambar</label>
                        <input type="file" name="lampiran" value="{{ old('lampiran') }}"
                            class="w-full border px-4 py-2 rounded text-sm focus:ring-2 focus:ring-lightBlue-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-blueGray-600 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="w-full border px-4 py-2 rounded text-sm focus:ring-2 focus:ring-lightBlue-500" required>{{ old('deskripsi') }}</textarea>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('staff.barang.index') }}"
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
