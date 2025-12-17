<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\KerusakanBarang;
use App\Models\Aset;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    public function index(Request $request)
    {
        $query = KerusakanBarang::with('aset')->latest();

        if ($request->status) {
            $query->where('kondisi', $request->status);
        }

        $kerusakan = $query->get();
        $status = $request->status;

        if ($request->ajax()) {
            return view('staff.kerusakan._table', compact('kerusakan'))->render();
        }

        return view('staff.kerusakan.index', compact('kerusakan', 'status'));
    }

    public function create()
    {
        // Cari aset yang belum ada record kerusakan aktif
        $usedIds = KerusakanBarang::whereIn('kondisi', ['perbaikan', 'rusak ringan', 'rusak berat'])
            ->pluck('aset_id')
            ->toArray();

        $asets = Aset::whereNotIn('id', $usedIds)->get();

        return view('staff.kerusakan.create', compact('asets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required|exists:asets,id',
            'deskripsi' => 'required|string',
        ]);

        $kerusakan = KerusakanBarang::create([
            'aset_id'   => $request->aset_id,
            'kondisi'   => 'rusak ringan', // Pastikan match ENUM ya
            'deskripsi' => $request->deskripsi,
        ]);

        // 🧩 Update kondisi di tabel asets juga
        $kerusakan->aset->update(['kondisi' => 'rusak ringan']);

        return redirect()->route('staff.kerusakan.index')->with('success', 'Data kerusakan & kondisi aset berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kerusakan = KerusakanBarang::with('aset')->findOrFail($id);
        return view('staff.kerusakan.edit', compact('kerusakan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required|in:baik,perbaikan,rusak ringan,rusak berat',
            'deskripsi' => 'required|string',
            'biaya_perbaikan' => $request->kondisi === 'baik' ? 'nullable|integer|min:0' : 'nullable',
            'catatan_perbaikan' => in_array($request->kondisi, ['baik', 'rusak berat'])
                ? 'required|string|max:255'
                : 'nullable|string|max:255',
        ]);

        $kerusakan = KerusakanBarang::findOrFail($id);

        $kerusakan->update([
            'kondisi' => $request->kondisi,
            'deskripsi' => $request->deskripsi,
            'biaya_perbaikan' => $request->kondisi === 'baik' ? $request->biaya_perbaikan : null,
            'catatan_perbaikan' => in_array($request->kondisi, ['baik', 'rusak berat'])
                ? $request->catatan_perbaikan
                : null,
        ]);

        // 🧩 UPDATE master aset juga!
        $kerusakan->aset->update(['kondisi' => $request->kondisi]);

        return redirect()->route('staff.kerusakan.index')->with('success', 'Data kerusakan & kondisi aset berhasil diperbarui!');
    }
}
