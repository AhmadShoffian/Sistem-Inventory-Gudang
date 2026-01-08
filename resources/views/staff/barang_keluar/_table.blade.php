<table class="items-center w-full bg-transparent border-collapse">
    <thead class="sticky top-0 bg-blueGray-100 z-0">
        <tr class="text-blueGray-600 text-xs uppercase">
            <th class="px-6 py-3 text-left">Kode Transaksi</th>
            <th class="px-6 py-3 text-left">Tanggal Keluar</th>
            <th class="px-6 py-3 text-left">Nama Barang</th>
            <th class="px-6 py-3 text-left">Stok Keluar</th>
            <th class="px-6 py-3 text-left">Customer</th>
            <th class="px-6 py-3 text-left">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($barangKeluars as $barangKeluar)
            <tr class="hover:bg-blueGray-50">
                <td class="px-6 py-4 text-sm text-blueGray-700 border-t border-blueGray-100">
                    {{ $barangKeluar->kode_transaksi }}
                </td>
                <td class="px-6 py-4 text-sm text-blueGray-700 border-t border-blueGray-100">
                    {{ $barangKeluar->tanggal_keluar }}
                </td>
                <td class="px-6 py-4 text-sm text-blueGray-700 border-t border-blueGray-100">
                    {{ $barangKeluar->barang->nama_barang }}
                </td>
                <td class="px-6 py-4 text-sm text-blueGray-700 border-t border-blueGray-100">
                    {{ $barangKeluar->jumlah_keluar }}
                </td>
                <td class="px-6 py-4 text-sm text-blueGray-700 border-t border-blueGray-100">
                    {{ $barangKeluar->customer->name }}
                </td>


                
{{-- 
                <td class="px-6 py-4 text-sm border-t border-blueGray-100">
                    {{ $barang->kategori->nama_kategori ?? '-' }}
                </td>

                <td class="px-6 py-4 text-sm border-t border-blueGray-100">
                    {{ $barang->satuan->nama_satuan ?? '-' }}
                </td>

                <td class="px-6 py-4 text-sm border-t border-blueGray-100">
                    {{ $barang->jumlah }}
                </td>

                <td class="px-6 py-4 text-sm border-t border-blueGray-100">
                    {{ $barang->created_at?->format('d-m-Y') ?? '-' }}
                </td> --}}

                <td class="px-6 py-4 border-t border-blueGray-100">
                    <div class="flex items-center space-x-2">
                        {{-- <a href="{{ route('staff.barang_masuk.show', $barangMasuk->id) }}"
                            class="text-blue-500 hover:text-blue-700 text-sm" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a> --}}

                        <a href="{{ route('staff.barang_keluar.edit', $barangKeluar->id) }}"
                            class="text-blue-500 hover:text-blue-700 text-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form method="POST" action="{{ route('staff.barang_keluar.destroy', $barangKeluar->id) }}"
                            class="form-delete inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm btn-delete"
                                data-nama="{{ $barangKeluar->nama_barang }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-blueGray-400 text-sm py-4">
                    Belum ada data barang.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
