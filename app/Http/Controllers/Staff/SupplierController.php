<?php

namespace App\Http\Controllers\Staff;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();
        $suppliers = $query->get();
        if ($request->ajax()) {
            return view('staff.supplier._table', compact('suppliers'))->render();
        }
        return view('staff.supplier.index', compact('suppliers'));
    }

    public function create() 
    {
        return view('staff.supplier.create');
    }
}
