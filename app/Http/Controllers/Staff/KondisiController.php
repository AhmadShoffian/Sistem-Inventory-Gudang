<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kondisi;

class KondisiController extends Controller
{
    public function index(Request $request)
    {
        $query = Kondisi::query();

        $kondisis = $query->get();

        if ($request->ajax()) {
            return view('staff.kondisi._table', compact('kondisis'))->render();
        }

        return view('staff.kondisi.index', compact('kondisis'));
        
    }
}
