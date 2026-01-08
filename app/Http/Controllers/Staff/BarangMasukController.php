<?php

namespace App\Http\Controllers\Staff;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    // public function index()
    // {
    //     return view('staff.barang_masuk.index', [
    //         'barangs' => Barang::all(),
    //         'barangsMasuk' => BarangMasuk::all(),
    //         'suppliers' => Supplier::all(),
    //     ]);
    // }

     public function index(Request $request)
    {
        $query = BarangMasuk::with(['supplier', 'satuan', 'barang']);

        // Dropdown kategori
        // $kategoris = Supplier::orderBy('name')->get();

        // Search nama barang
        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        $barangMasuks = $query->get();

        // AJAX
        if ($request->ajax()) {
            return view('staff.barang_masuk._table', compact('barangMasuks'))->render();
        }

        return view('staff.barang_masuk.index', compact('barangMasuks'));
    }

    public function getDataBarangMasuk()
    {
        return response()->json([
            'success' => true,
            'data' => BarangMasuk::all(),
            'supplier' => Supplier::all()
        ]);
    }

    public function create()
    {
        return view('staff.barang_masuk.create', [
            'barangs' => Barang::all(),
            'suppliers' => Supplier::all(),
            'satuans' => Satuan::all(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang_masuk' => 'required|unique:barang_masuks,kode_barang_masuk',
            'tanggal_masuk'  => 'required|date',
            'barang_id'      => 'required|exists:barang,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'jumlah_masuk'   => 'required|integer|min:1',
            'satuan_id'      => 'required|exists:satuan_barang,id',
        ]);

        DB::transaction(function () use ($request) {

            $barang = Barang::lockForUpdate()->findOrFail($request->barang_id);

            if ($barang->satuan_id != $request->satuan_id) {
                abort(403, 'Satuan tidak sesuai dengan barang');
            }

            BarangMasuk::create([
                'kode_barang_masuk' => $this->generateKodeTransaksi(),
                'tanggal_masuk'  => $request->tanggal_masuk,
                'barang_id'      => $request->barang_id,
                'supplier_id'    => $request->supplier_id,
                'jumlah_masuk'   => $request->jumlah_masuk,
                'satuan_id'      => $request->satuan_id,
                'created_by_user_id' => auth()->id(),
            ]);

            $barang->increment('jumlah', $request->jumlah_masuk);
        });

        return redirect()
            ->route('staff.barang_masuk.index')
            ->with('success', 'Barang masuk berhasil ditambahkan dan stok otomatis bertambah.');
    }




    public function getAutoCompleteData(Request $request)
    {
        $barang = Barang::where('nama_barang', $request->nama_barang)->first();;
        if ($barang) {
            return response()->json([
                'nama_barang'   => $barang->nama_barang,
                'stok'          => $barang->stok,
                'satuan_id'     => $barang->satuan_id,
            ]);
        }
    }

    public function getSatuan()
    {
        $satuans = Satuan::all();

        return response()->json($satuans);
    }

    private function generateKodeTransaksi()
    {
        $tanggal = Carbon::now()->format('Ymd');

        $last = BarangMasuk::whereDate('created_at', now()->toDateString())
            ->orderBy('id', 'desc')
            ->first();

        $urutan = $last
            ? intval(substr($last->kode_transaksi, -4)) + 1
            : 1;

        return 'TRX-IN-' . $tanggal . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
    }

    public function getStokBarang($id)
    {
        $barang = Barang::findOrFail($id);

        return response()->json([
            'stok' => $barang->jumlah,
            'satuan_id' => $barang->satuan_id
        ]);
    }
}
