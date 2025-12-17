<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use App\Models\Barang;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::with('barang')->latest()->get();
        return view('staff.pengeluaran.index', compact('pengeluarans'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('staff.pengeluaran.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengeluaran' => 'required|date',
            'dipakai_oleh' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jumlah > $barang->ketersediaan) {
            return back()->withErrors(['jumlah' => 'Jumlah pengeluaran melebihi stok tersedia!'])->withInput();
        }

        Pengeluaran::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'dipakai_oleh' => $request->dipakai_oleh,
            'keterangan' => $request->keterangan,
        ]);

        $barang->decrement('ketersediaan', $request->jumlah);

        return redirect()->route('staff.pengadaan.index')->with('success', 'Data pengeluaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $barangs = Barang::all();
        return view('staff.pengeluaran.edit', compact('pengeluaran', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $barang = Barang::findOrFail($pengeluaran->barang_id);

        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengeluaran' => 'required|date',
            'dipakai_oleh' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Balikin stok lama dulu
        $barang->increment('ketersediaan', $pengeluaran->jumlah);

        if ($request->jumlah > $barang->ketersediaan) {
            return back()->withErrors(['jumlah' => 'Jumlah pengeluaran melebihi stok tersedia!'])->withInput();
        }

        $pengeluaran->update([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'dipakai_oleh' => $request->dipakai_oleh,
            'keterangan' => $request->keterangan,
        ]);

        $barang->decrement('ketersediaan', $request->jumlah);

        return redirect()->route('staff.pengeluaran.index')->with('success', 'Data pengeluaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $barang = Barang::findOrFail($pengeluaran->barang_id);

        $barang->increment('ketersediaan', $pengeluaran->jumlah);

        $pengeluaran->delete();

        return redirect()->route('staff.pengadaan.index')->with('success', 'Data pengeluaran berhasil dihapus!');
    }
}
