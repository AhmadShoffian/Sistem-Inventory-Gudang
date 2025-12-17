<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $query = Aset::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama_aset', 'like', "%$search%")
                ->orWhere('kode_barang', 'like', "%$search%");
        }

        $asets = $query->get();

        if ($request->ajax()) {
            return view('staff.aset._table', compact('asets'))->render();
        }

        return view('staff.aset.index', compact('asets'));
    }

    public function create()
    {
        return view('staff.aset.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'kode_barang' => 'required|string',
            'nama_aset' => 'required|string|max:255',
            'no_reg' => 'nullable|string',
            'merk_type' => 'nullable|string',
            'ukuran_cc' => 'nullable|string',
            'bahan' => 'nullable|string',
            'tahun_pembelian' => 'nullable|integer',
            'nomor_pabrik' => 'nullable|string',
            'nomor_rangka' => 'nullable|string',
            'nomor_mesin' => 'nullable|string',
            'nomor_polisi' => 'nullable|string',
            'nomor_bpkb' => 'nullable|string',
            'asal_usul' => 'nullable|string',
            'harga_satuan' => 'nullable|integer|min:0',
            'keberadaan' => 'nullable|string',
            'kondisi' => 'nullable|string',
            'paraf' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        Aset::create($validated);

        return redirect()->route('staff.aset.index')->with('success', 'Aset berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        return view('staff.aset.edit', compact('aset'));
    }

    public function update(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);

        $rules = [
            'kode_barang' => 'required|string',
            'nama_aset' => 'required|string|max:255',
            'no_reg' => 'nullable|string',
            'merk_type' => 'nullable|string',
            'ukuran_cc' => 'nullable|string',
            'bahan' => 'nullable|string',
            'tahun_pembelian' => 'nullable|integer',
            'nomor_pabrik' => 'nullable|string',
            'nomor_rangka' => 'nullable|string',
            'nomor_mesin' => 'nullable|string',
            'nomor_polisi' => 'nullable|string',
            'nomor_bpkb' => 'nullable|string',
            'asal_usul' => 'nullable|string',
            'harga_satuan' => 'nullable|integer|min:0',
            'keberadaan' => 'nullable|string',
            'kondisi' => 'nullable|string',
            'paraf' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        $aset->update($validated);

        return redirect()->route('staff.aset.index')->with('success', 'Aset berhasil diupdate!');
    }

    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        $aset->delete();

        return redirect()->route('staff.aset.index')->with('success', 'Aset berhasil dihapus!');
    }
}