<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Satuan;

class SatuanController extends Controller
{
    public function index(Request $request)
    {
        $query = Satuan::query();

        $satuans = $query->get();

        if ($request->ajax()) {
            return view('staff.satuan._table', compact('satuans'))->render();
        }

        return view('staff.satuan.index', compact('satuans'));
        
    }
}
