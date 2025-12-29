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
}
