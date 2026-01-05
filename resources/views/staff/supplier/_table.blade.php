<table class="items-center w-full bg-transparent border-collapse">
    <thead class="sticky top-0 bg-blueGray-100 z-0">
        <tr class="text-blueGray-600 text-xs uppercase">
            <th class="px-6 py-3 text-left">Nama Perusahaan</th>
            <th class="px-6 py-3 text-left">Alamat</th>
            <th class="px-6 py-3 text-left">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($suppliers as $supplier)
            <tr class="hover:bg-blueGray-50">
                <td class="px-6 py-4 text-sm text-blueGray-700 border-t border-blueGray-100">
                    {{ $supplier->name }}
                </td>

                <td class="px-6 py-4 text-sm border-t border-blueGray-100">
                    {{ $supplier->alamat }}
                </td>

                <td class="px-6 py-4 border-t border-blueGray-100">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('staff.supplier.edit', $supplier->id) }}"
                            class="text-blue-500 hover:text-blue-700 text-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form method="POST" action="{{ route('staff.supplier.destroy', $supplier->id) }}"
                            class="form-delete inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm btn-delete"
                                data-nama="{{ $supplier->name }}" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-blueGray-400 text-sm py-4">
                    Belum ada data supplier.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
