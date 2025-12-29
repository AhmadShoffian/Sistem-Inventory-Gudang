<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Lokasi::query();

        $lokasis = $query->get();

        if ($request->ajax()) {
            return view('staff.lokasi._table', compact('lokasis'))->render();
        }

        return view('staff.lokasi.index', compact('lokasis'));
    }

    public function create()
    {
        return view('staff.lokasi.create');
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
        ]);

        Lokasi::create([
            'nama_lokasi' => $validated['nama_lokasi']
        ]);

        return redirect()
            ->route('staff.lokasi.index')
            ->with('success', 'Lokasi berhasil ditambahkan!');
    }
}
