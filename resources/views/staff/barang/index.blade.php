@extends('layouts.staff')

{{-- Header --}}
@section('header')
    <div class="relative bg-lightBlue-600 md:pt-32 pb-44 pt-12">
        <div class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-16 px-4">
            <div>
                <h2 class="text-white text-2xl md:text-3xl uppercase font-bold tracking-tight">
                    Data Barang
                </h2>
                <p class="mt-2 md:mt-3 text-sm md:text-base leading-relaxed text-white opacity-80">
                    Berikut adalah daftar seluruh barang inventaris, baik habis pakai maupun barang tetap.
                </p>
            </div>
        </div>
    </div>
@endsection

{{-- Konten --}}
@section('staff-content')
    <div class="px-6 -mt-32">

        {{-- Flash Message --}}
        {{-- @if (session('success'))
    <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-2 rounded mb-4 text-sm">
      {{ session('success') }}
    </div>
  @endif --}}

        {{-- Card Table --}}
        <div x-data="liveBarang()" x-init="fetchTable()"
            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
            {{-- Header + Search + Button --}}
            <div
                class="rounded-t px-4 py-3 border-b border-blueGray-100 bg-blueGray-50 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h3 class="font-semibold text-base text-blueGray-700">Tabel Barang</h3>
                <div class="flex flex-wrap items-center gap-2">
                    {{-- Dropdown kategori --}}
                    <select x-model="kategori" @change="fetchTable()"
                        class="px-2 py-2 pr-8 border border-blueGray-200 rounded text-xs focus:outline-none">
                        <option value="">Semua kategori</option>
                        {{-- @foreach ($kategoris as $kategori)
            <option value="{{ $kategori }}">{{ $kategori }}</option>
          @endforeach --}}
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Input Search --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-blueGray-400 text-sm"></i>
                        </div>
                        <input type="text" x-model="search" placeholder="Cari barang..."
                            @input.debounce.500ms="fetchTable()"
                            class="pl-10 pr-4 py-2 border border-blueGray-200 rounded text-xs focus:outline-none focus:ring-2 focus:ring-lightBlue-500 w-52" />
                    </div>
                    {{-- Tombol Tambah --}}
                    <a href="{{ route('staff.barang.create') }}"
                        class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs px-4 py-2 rounded shadow transition">
                        + Tambah Barang
                    </a>
                </div>
            </div>

            {{-- Table Scrollable --}}
            <div class="block w-full overflow-x-auto max-h-[500px] overflow-y-auto">
                <div id="table-container">
                    @include('staff.barang._table')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script>
        function liveBarang() {
            return {
                search: '{{ request('search') }}',
                kategori: '',
                fetchTable() {
                    const params = new URLSearchParams({
                        search: this.search,
                        kategori: this.kategori,
                    });

                    fetch(`{{ route('staff.barang.index') }}?${params.toString()}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById('table-container').innerHTML = html;
                        });
                }
            }
        }
    </script> --}}

    <script>
        function liveBarang() {
            return {
                search: '{{ request('search') }}',
                kategori_id: '{{ request('kategori_id') }}',

                fetchTable() {
                    const params = new URLSearchParams();

                    if (this.search) {
                        params.append('search', this.search);
                    }

                    if (this.kategori_id) {
                        params.append('kategori_id', this.kategori_id);
                    }

                    fetch(`{{ route('staff.barang.index') }}?${params.toString()}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById('table-container').innerHTML = html;
                        });
                }
            }
        }
    </script>

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

    {{-- SweetAlert Konfirmasi Hapus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const nama = this.getAttribute('data-nama') || 'barang ini';

                    Swal.fire({
                        title: 'Yakin mau hapus?',
                        text: `Data "${nama}" akan dihapus secara permanen.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
