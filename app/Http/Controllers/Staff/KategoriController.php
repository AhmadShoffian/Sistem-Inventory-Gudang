<?php

namespace App\Http\Controllers\Staff;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::query();

        $kategoris = $query->get();
        if ($request->ajax()) {
            return view('staff.kategori._table', compact('kategoris'))->render();
        }

        return view('staff.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('staff.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $validated['nama_kategori']
        ]);

        return redirect()
            ->route('staff.barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }
}
