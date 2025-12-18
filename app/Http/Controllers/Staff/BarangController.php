<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        // $query = Barang::query();

        // $kategoris = Barang::select('kategori')->distinct()->pluck('kategori');

        // if ($request->has('search') || $request->has('kategori')) {
        //     $search = $request->search;
        //     $query->where(function ($q) use ($search) {
        //         $q->where('nama_barang', 'like', $search . '%')
        //           ->orWhere('nama_barang', 'like', '% ' . $search . '%')
        //           ->orWhere('nama_barang', 'like', '%' . $search . '%');
        //     });

        //     if ($request->kategori) {
        //         $query->where('kategori', $request->kategori);
        //     }
        // }

        // $barangs = $query->get();

        // if ($request->ajax()) {
        //     return view('staff.barang._table', compact('barangs'))->render();
        // }

        // return view('staff.barang.index', compact('barangs', 'kategoris'));

        $user = Auth::user();

        $queryBarang = Barang::with(['kategori', 'lokasi', 'satuan', 'kondisi']);
        $barangs = $queryBarang->get();

        return view('staff.barang.index', compact('user', 'barangs'));
    }

    public function create()
    {
        return view('staff.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
            'ketersediaan' => 'required|integer|min:1',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'ketersediaan' => $request->ketersediaan, 
        ]);

        return redirect()->route('staff.barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('staff.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
            // ketersediaan tetap dihandle lewat pengadaan ya!
        ]);

        return redirect()->route('staff.barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('staff.barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
