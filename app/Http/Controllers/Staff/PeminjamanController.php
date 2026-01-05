<?php

namespace App\Http\Controllers\Staff;

use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengembalian::query();

        $pengembalians = $query->get();

        if ($request->ajax()) {
            return view('staff.pengembalian._table', compact('pengembalians'))->render();
        }

        return view('staff.pengembalian.index', compact('pengembalians'));
    }

}
