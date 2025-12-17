<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Pengadaan;
use App\Models\Barang;
use Illuminate\Http\Request;


class PengadaanController extends Controller
{
    public function index()
    {
        $pengadaans = Pengadaan::with('barang')->latest()->get();
        $pengeluarans = \App\Models\Pengeluaran::with('barang')->latest()->get();

        return view('staff.pengadaan.index', compact('pengadaans', 'pengeluarans'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('staff.pengadaan.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'nullable|integer|min:0',
            'tanggal_pengadaan' => 'required|date',
            'supplier' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $total = $request->harga_satuan ? $request->jumlah * $request->harga_satuan : null;

        $pengadaan = Pengadaan::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'total_harga' => $total,
            'supplier' => $request->supplier,
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
            'keterangan' => $request->keterangan,
        ]);

        // Update ketersediaan barang
        $barang = Barang::find($request->barang_id);
        $barang->increment('ketersediaan', $request->jumlah);

        return redirect()->route('staff.pengadaan.index')->with('success', 'Data pengadaan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengadaan = Pengadaan::findOrFail($id);
        $barangs = Barang::all();
        return view('staff.pengadaan.edit', compact('pengadaan', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $pengadaan = Pengadaan::findOrFail($id);

        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'nullable|integer|min:0',
            'tanggal_pengadaan' => 'required|date',
            'supplier' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $oldJumlah = $pengadaan->jumlah;

        $total = $request->harga_satuan ? $request->jumlah * $request->harga_satuan : null;

        $pengadaan->update([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'total_harga' => $total,
            'supplier' => $request->supplier,
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
            'keterangan' => $request->keterangan,
        ]);

        // Update stok barang: rollback jumlah lama, tambah jumlah baru
        $barang = Barang::find($request->barang_id);
        $barang->ketersediaan = $barang->ketersediaan - $oldJumlah + $request->jumlah;
        $barang->save();

        return redirect()->route('staff.pengadaan.index')->with('success', 'Data pengadaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengadaan = Pengadaan::findOrFail($id);

        // Rollback stok barang
        $barang = Barang::find($pengadaan->barang_id);
        $barang->decrement('ketersediaan', $pengadaan->jumlah);

        $pengadaan->delete();

        return redirect()->route('staff.pengadaan.index')->with('success', 'Data pengadaan berhasil dihapus!');
    }
}
