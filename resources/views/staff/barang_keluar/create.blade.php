@extends('layouts.staff')

@section('header')
    <div class="relative bg-lightBlue-600 md:pt-32 pb-44 pt-12">
        <div class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-16 px-4">
            <div>
                <h2 class="text-white text-2xl md:text-3xl uppercase font-bold tracking-tight">
                    Tambah Data Barang Keluar
                </h2>
                <p class="mt-2 md:mt-3 text-sm md:text-base leading-relaxed text-white opacity-80">
                    Silakan isi data barang keluar yang ingin ditambahkan ke dalam sistem inventaris.
                </p>
            </div>
        </div>
    </div>
@endsection

@section('staff-content')
    <div class="px-6 -mt-32">

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
            <div class="rounded-t px-6 py-3 border-0 bg-blueGray-50">
                <h3 class="font-semibold text-base text-blueGray-700">Form Tambah Barang Keluar</h3>
            </div>

            <div class="px-6 py-6">
                <form method="POST" action="{{ route('staff.barang_keluar.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-blueGray-600 mb-1">Tanggal Keluar</label>
                        <input type="date" value="{{ now()->toDateString() }}"
                            class="w-full border px-4 py-2 rounded text-sm bg-gray-100 cursor-not-allowed" disabled>
                        <input type="hidden" name="tanggal_keluar" value="{{ now()->toDateString() }}">
                    </div>


                    <div class="mb-4">
                        <label for="kode_transaksi">Kode Transaksi</label>
                        <input type="text" name="kode_transaksi" id="kode_transaksi"
                            class="w-full border px-4 py-2 rounded text-sm bg-gray-100" readonly>

                    </div>

                    <div class="mb-4">
                        <label for="barang_id">Pilih Barang</label>
                        <select name="barang_id" id="barang_id" class="w-full border px-4 py-2 rounded text-sm" required>
                            <option value="" disabled selected>-- Pilih Barang --</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">
                                    {{ $barang->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="stok">Stok Saat Ini</label>
                        <input type="number" id="stok"
                            class="w-full border px-4 py-2 rounded text-sm bg-gray-100 cursor-not-allowed" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="nama_supplier">Pilih Customer</label>
                        <select name="customer_id" id="customer_id"
                            class="w-full border px-4 py-2 rounded text-sm focus:outline-none focus:ring-2 focus:ring-lightBlue-500"
                            required>
                            <option value="" disabled selected>-- Pilih Customer --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-4">
                        <label for="jumlah_keluar">Jumlah Keluar</label>
                        <input type="number" name="jumlah_keluar" id="jumlah_keluar" value="{{ old('jumlah_keluar') }}"
                            class="w-full border px-4 py-2 rounded text-sm focus:outline-none focus:ring-2 focus:ring-lightBlue-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="satuan_id">Satuan</label>
                        <select id="satuan_display"
                            class="w-full border px-4 py-2 rounded text-sm bg-gray-100 cursor-not-allowed" disabled>
                            <option value="">-- Satuan --</option>
                            @foreach ($satuans as $satuan)
                                <option value="{{ $satuan->id }}">
                                    {{ $satuan->nama_satuan }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="satuan_id" id="satuan_id">
                    </div>


                    <div class="flex justify-end gap-2">
                        <a href="{{ route('staff.barang_masuk.index') }}"
                            class="bg-blueGray-100 hover:bg-blueGray-200 text-blueGray-600 text-xs font-semibold px-4 py-2 rounded shadow transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-lightBlue-500 hover:bg-lightBlue-600 text-white font-bold text-xs px-6 py-2 rounded shadow transition">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

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
    </script>
    <script>
        function generateKodeTransaksi() {
            const now = new Date();

            const yyyy = now.getFullYear();
            const mm = String(now.getMonth() + 1).padStart(2, '0');
            const dd = String(now.getDate()).padStart(2, '0');

            const random = Math.floor(Math.random() * 10000)
                .toString()
                .padStart(4, '0');

            const kode = `TRX-OUT-${yyyy}${mm}${dd}-${random}`;

            document.getElementById('kode_transaksi').value = kode;
        }

        document.addEventListener('DOMContentLoaded', function() {
            generateKodeTransaksi();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stokUrl = "{{ route('staff.barang.stok', ':id') }}";

            const barangSelect = document.getElementById('barang_id');
            const stokInput = document.getElementById('stok');
            const satuanHidden = document.getElementById('satuan_id');
            const satuanDisplay = document.getElementById('satuan_display');

            barangSelect.addEventListener('change', function() {
                const barangId = this.value;

                fetch(stokUrl.replace(':id', barangId))
                    .then(res => {
                        if (!res.ok) throw new Error('Gagal ambil data barang');
                        return res.json();
                    })
                    .then(data => {
                        // ✔ isi stok
                        stokInput.value = data.stok;

                        // ✔ isi hidden input (untuk dikirim ke backend)
                        satuanHidden.value = data.satuan_id;

                        // ✔ set selected option di select display
                        satuanDisplay.value = data.satuan_id;
                    })
                    .catch(err => {
                        console.error(err);
                        stokInput.value = '';
                        satuanHidden.value = '';
                        satuanDisplay.value = '';
                    });
            });
        });
    </script>
@endsection
