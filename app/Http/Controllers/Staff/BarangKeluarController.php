<?php

namespace App\Http\Controllers\Staff;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangKeluar::with(['customer', 'satuan', 'barang']);

        // Dropdown kategori
        // $kategoris = Supplier::orderBy('name')->get();

        // Search nama barang
        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        $barangKeluars = $query->get();

        // AJAX
        if ($request->ajax()) {
            return view('staff.barang_keluar._table', compact('barangKeluars'))->render();
        }

        return view('staff.barang_keluar.index', compact('barangKeluars'));
    }

    public function create()
    {
        return view('staff.barang_keluar.create', [
            'barangs' => Barang::all(),
            'customers' => Customer::all(),
            'satuans' => Satuan::all(),
        ]);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'kode_transaksi' => 'required|unique:barang_keluars,kode_transaksi',
    //         'tanggal_keluar' => 'required|date',
    //         'barang_id' => 'required|exists:barang,id',
    //         'jumlah_keluar' => 'required|integer|min:1',
    //         'customer_id' => 'required|exists:customers,id',
    //         'satuan_id' => 'required|exists:satuan_barang,id',
    //     ]);

    //     DB::transaction(function () use ($request) {
    //        $barang = Barang::lockForUpdate()->findOrFail($request->barang_id);

    //        if ($barang->satuan_id != $request->satuan_id) {
    //             abort(403, 'Satuan tidak sesuai dengan barang');
    //        }

    //        BarangKeluar::create([
    //             'kode_transaksi'        => $request->kode_transaksi,
    //             'tanggal_keluar'        => $request->tanggal_keluar,
    //             'barang_id'             => $request->barang_id,
    //             'jumlah_keluar'         => $request->jumlah_keluar,
    //             'customer_id'           => $request->customer_id,
    //             'satuan_id'             => $request->satuan_id,
    //             'created_by_user_id'    => auth()->user()->id,
    //         ]);
    //         if ($barang->jumlah < $request->jumlah_keluar) {
    //             abort(403, 'Stok barang tidak mencukupi');
    //         }
    //         $barang->decrement('jumlah', $request->jumlah_keluar);
    //     });
    //     return redirect()->route('staff.barang_keluar.index')->with('success', 'Data barang keluar berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:barang_keluars,kode_transaksi',
            'tanggal_keluar' => 'required|date',
            'barang_id' => 'required|exists:barang,id',
            'jumlah_keluar' => 'required|integer|min:1',
            'customer_id' => 'required|exists:customers,id',
            'satuan_id' => 'required|exists:satuan_barang,id',
        ]);

        DB::transaction(function () use ($request) {
            $barang = Barang::lockForUpdate()->findOrFail($request->barang_id);

            if ($barang->satuan_id != $request->satuan_id) {
                abort(403, 'Satuan tidak sesuai dengan barang');
            }

            if ($barang->jumlah < $request->jumlah_keluar) {
                abort(403, 'Stok tidak mencukupi');
            }

            BarangKeluar::create([
                'kode_transaksi'     => $request->kode_transaksi,
                'tanggal_keluar'     => $request->tanggal_keluar,
                'barang_id'          => $request->barang_id,
                'jumlah_keluar'      => $request->jumlah_keluar,
                'customer_id'        => $request->customer_id,
                'satuan_id'          => $request->satuan_id,
                'created_by_user_id' => auth()->id(),
            ]);

            $barang->decrement('jumlah', $request->jumlah_keluar);
        });

        return redirect()->route('staff.barang_keluar.index')
            ->with('success', 'Data barang keluar berhasil ditambahkan.');
    }

    public function getStokBarang($id)
    {
        $barang = Barang::findOrFail($id);

        return response()->json([
            'stok' => $barang->jumlah,   // kolom stok di tabel barang
            'satuan_id' => $barang->satuan_id,
        ]);
    }
}
