<?php

namespace App\Http\Controllers\Staff;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    public function index()
    {
        return view('staff.barang_masuk.index', [
            'barangs' => Barang::all(),
            'barangsMasuk' => BarangMasuk::all(),
            'suppliers' => Supplier::all(),
        ]);
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
        $validator = Validator::make($request->all(), [
            'kode_transaksi'    => 'required|string|max:255',
            'tanggal_masuk'     => 'required|date',
            'nama_barang'       => 'required|string|max:255',
            'jumlah_barang'     => 'required|integer',
            'supplier_id'       => 'required|exists:suppliers,id',
        ], [
            'kode_transaksi.required'   => 'Kode Transaksi wajib diisi.',
            'tanggal_masuk.required'    => 'Tanggal Masuk wajib diisi.',
            'nama_barang.required'      => 'Nama Barang wajib diisi.',
            'jumlah_barang.required'    => 'Jumlah Barang wajib diisi.',
            'supplier_id.required'      => 'Supplier wajib dipilih.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $barangMasuk = BarangMasuk::create([
            'kode_transaksi' => $this->generateKodeTransaksi(),
            'tanggal_masuk'        => $request->tanggal_masuk,
            'nama_barang'          => $request->nama_barang,
            'jumlah_masuk'         => $request->jumlah_barang,
            'supplier_id'          => $request->supplier_id,
            'created_by_user_id'   => auth()->user()->id,
        ]);

        if ($barangMasuk) {
            $barang = Barang::where('nama_barang', $request->nama_barang)->first();
            if ($barang) {
                $barang->stok += $request->jumlah_barang;
                $barang->save();
            }
        }

        return redirect()
            ->route('staff.barang_masuk.index')
            ->with('success', 'Barang Masuk berhasil ditambahkan!');
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
}
