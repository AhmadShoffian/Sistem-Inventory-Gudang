<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    public function index()
    {
        $skpds = Skpd::orderBy('tanggal_masuk', 'asc')->get();
        $totalKotak = $skpds->count();
        $totalSisa = $skpds->sum('jumlah_sisa');

        return view('staff.skpd.index', compact('skpds', 'totalKotak', 'totalSisa'));
    }

    public function create()
    {
        return view('staff.skpd.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kotak' => 'required|unique:skpds,kode_kotak',
            'jenis_skpd' => 'required|in:kendaraan,alat_berat',
            'jumlah_awal' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ], [
            'kode_kotak.required' => 'Kode kotak wajib diisi.',
            'kode_kotak.unique' => 'Kode kotak ini sudah digunakan.',
            'jenis_skpd.required' => 'Jenis SKPD wajib dipilih.',
            'jenis_skpd.in' => 'Jenis SKPD tidak valid.',
            'jumlah_awal.required' => 'Jumlah awal wajib diisi.',
            'jumlah_awal.integer' => 'Jumlah awal harus berupa angka.',
            'jumlah_awal.min' => 'Jumlah awal minimal 1 lembar.',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
            'tanggal_masuk.date' => 'Format tanggal masuk tidak valid.',
        ]);

        Skpd::create([
            'kode_kotak' => $request->kode_kotak,
            'jenis_skpd' => $request->jenis_skpd,
            'jumlah_awal' => $request->jumlah_awal,
            'jumlah_sisa' => $request->jumlah_awal, // default: sama dengan awal
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('staff.skpd.index')->with('success', 'Kotak SKPD berhasil ditambahkan.');
    }

    public function destroy(Skpd $skpd)
    {
        $skpd->delete();
        return redirect()->route('staff.skpd.index')->with('success', 'Kotak SKPD berhasil dihapus.');
    }
}