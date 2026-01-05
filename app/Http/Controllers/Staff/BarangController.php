<?php

namespace App\Http\Controllers\Staff;

use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Satuan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = Barang::query();

    //     $kategoris = Barang::select('kategori')->distinct()->pluck('kategori');

    //     if ($request->has('search') || $request->has('kategori')) {
    //         $search = $request->search;
    //         $query->where(function ($q) use ($search) {
    //             $q->where('nama_barang', 'like', $search . '%')
    //               ->orWhere('nama_barang', 'like', '% ' . $search . '%')
    //               ->orWhere('nama_barang', 'like', '%' . $search . '%');
    //         });

    //         if ($request->kategori) {
    //             $query->where('kategori', $request->kategori);
    //         }
    //     }

    //     $barangs = $query->get();

    //     if ($request->ajax()) {
    //         return view('staff.barang._table', compact('barangs'))->render();
    //     }

    //     return view('staff.barang.index', compact('barangs', 'kategoris'));
    // }

    public function index(Request $request)
    {
        $query = Barang::with(['kategori', 'satuan', 'kondisi', 'lokasi']);

        // Dropdown kategori
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        // Search nama barang
        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $barangs = $query->get();

        // AJAX
        if ($request->ajax()) {
            return view('staff.barang._table', compact('barangs'))->render();
        }

        return view('staff.barang.index', compact('barangs', 'kategoris'));
    }

    public function create()
    {
        return view('staff.barang.create', [
            'kategoris' => Kategori::orderBy('nama_kategori')->get(),
            'satuans'   => Satuan::orderBy('nama_satuan')->get(),
            'lokasis'   => Lokasi::orderBy('nama_lokasi')->get(),
        ]);
    }

    // public function store(Request $request)
    // {
    //     $validated = Validator::make($request->all(), [
    //         'nama_barang' => 'required|string|max:255',
    //         'kategori_id' => 'required|exists:kategori_barang,id',
    //         'satuan_id'   => 'required|exists:satuan_barang,id',
    //         'lokasi_id'   => 'required|exists:lokasi,id',
    //         'jumlah'      => 'required|integer|min:1',
    //         'deskripsi'   => 'required|string',
    //         'lampiran'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
    //     ], [
    //         'nama_barang.required' => ' Form Nama barang wajib diisi !',
    //         'deskripsi.required' => 'Form Deskripsi wajib diisi !',
    //         'lampiran.mimes' => 'Lampiran wajib berupa file gambar (jpg, jpeg, png) !',
    //         'lampiran.max' => 'Ukuran file lampiran maksimal 2MB !',
    //         'jumlah.min' => 'Jumlah barang minimal 1 !',
    //         'jumlah.required' => 'Form Jumlah barang wajib diisi !',
    //         'kategori_id.required' => 'Pilih Kategori Barang !',
    //         'satuan_id.required' => 'Pilih Satuan Barang !',
    //         'lokasi_id.required' => 'Pilih Lokasi Barang !',
    //     ]);

    //     if ($request->hasFile('lampiran')) {
    //         $path = 'lampiran-gambar/';
    //         $file = $request->file('lampiran');
    //         $fileName = $file->getClientOriginalName();
    //         $lampiran = $file->storeAs($path, $fileName, 'public');
    //     } else {
    //         $lampiran = null;
    //     }

    //     $kode_barang = 'BRG-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
    //     $request->merge([
    //         'kode_barang' => $kode_barang,
    //         'lampiran'    => $lampiran,
    //         'user_id'     => auth()->user()->id,
    //     ]);

    //    if ($validated->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'errors' => $validated->errors(),
    //         ], 422);
    //    }

    //     Barang::create([
    //         'nama_barang'        => $validated['nama_barang'],
    //         'deskripsi'          => $validated['deskripsi'],
    //         'lampiran'           => $lampiran,
    //         'kode_barang'        => $kode_barang,
    //         'kategori_id'        => $validated['kategori_id'],
    //         'satuan_id'          => $validated['satuan_id'],
    //         'jumlah'             => $validated['jumlah'],
    //         'lokasi_id'          => $validated['lokasi_id'],
    //         'status_barang'      => 'aktif',
    //         'created_by_user_id' => auth()->id(),
    //     ]);

    //     return redirect()
    //         ->route('staff.barang.index')
    //         ->with('success', 'Barang berhasil ditambahkan!');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_barang,id',
            'satuan_id'   => 'required|exists:satuan_barang,id',
            'lokasi_id'   => 'required|exists:lokasi,id',
            'jumlah'      => 'required|integer|min:1',
            'deskripsi'   => 'required|string',
            'lampiran'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_barang.required' => 'Form Nama barang wajib diisi!',
            'deskripsi.required'   => 'Form Deskripsi wajib diisi!',
            'lampiran.mimes'       => 'Lampiran wajib berupa file gambar (jpg, jpeg, png)!',
            'lampiran.max'         => 'Ukuran file lampiran maksimal 2MB!',
            'jumlah.min'           => 'Jumlah barang minimal 1!',
            'kategori_id.required' => 'Pilih Kategori Barang!',
            'satuan_id.required'   => 'Pilih Satuan Barang!',
            'lokasi_id.required'   => 'Pilih Lokasi Barang!',
        ]);

        // Upload file
        $lampiran = null;
        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran')
                ->store('lampiran-gambar', 'public');
        }

        $kode_barang = 'BRG-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

        Barang::create([
            'nama_barang'        => $validated['nama_barang'],
            'deskripsi'          => $validated['deskripsi'],
            'lampiran'           => $lampiran,
            'kode_barang'        => $kode_barang,
            'kategori_id'        => $validated['kategori_id'],
            'satuan_id'          => $validated['satuan_id'],
            'jumlah'             => $validated['jumlah'],
            'lokasi_id'          => $validated['lokasi_id'],
            'status_barang'      => 'aktif',
            'created_by_user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('staff.barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
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
