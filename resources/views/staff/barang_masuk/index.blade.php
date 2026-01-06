@extends('layouts.staff')

{{-- Header --}}
@section('header')
    <div class="relative bg-lightBlue-600 md:pt-32 pb-44 pt-12">
        <div class="w-full mx-auto flex justify-between md:flex-nowrap flex-wrap md:px-16 px-4">
            <div>
                <h2 class="text-white text-2xl md:text-3xl uppercase font-bold tracking-tight">
                    Data Barang Masuk
                </h2>
                <p class="mt-2 md:mt-3 text-sm md:text-base leading-relaxed text-white opacity-80">
                    Berikut adalah daftar barang masuk terbaru.
                </p>
            </div>
        </div>
    </div>
@endsection

{{-- Konten --}}
@section('staff-content')
    <div class="px-6 -mt-32">

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-2 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ===== TABEL BARANG MASUK ===== --}}
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded">
            <div class="rounded-t px-4 py-3 border-b bg-blueGray-50 flex justify-between items-center">
                <h3 class="font-semibold text-base text-blueGray-700">Data Barang Masuk</h3>
                <a href="{{ route('staff.barang_masuk.create') }}"
                    class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs px-4 py-2 rounded shadow transition">
                    + Tambah Barang Masuk
                </a>
            </div>
            <div class="block w-full overflow-x-auto">
                @include('staff.barang_masuk._table') {{-- Bikin partial table untuk barang masuk --}}
            </div>
        </div>

    </div>
@endsection

{{-- SweetAlert + Konfirmasi --}}
@section('scripts')
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

        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const nama = this.getAttribute('data-nama') || 'data ini';

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
     <script>
        function generateKodeTransaksi() {
            var tanggal = new Date().toLocaleDateString('id-ID').split('/').reverse().join('-');
            var randomNumber = Math.floor(Math.random() * 10000).toString().padStart(4, '0');
            var kodeTransaksi = 'TRX-IN-' + tanggal + '-' + randomNumber;

            $('#kode_transaksi').val(kodeTransaksi);
            return kodeTransaksi;
        }

        $(document).ready(function() {
            generateKodeTransaksi();
        });
    </script>
@endsection
