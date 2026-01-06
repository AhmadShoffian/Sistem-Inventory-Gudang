<?php

namespace App\Http\Controllers\Staff;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $supplier = Supplier::create([
            'name'                  => $request->name,
            'alamat'                => $request->alamat,
            'created_by_user_id'    => auth()->user()->id,
        ]);

        return redirect()
            ->route('staff.supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan!');
    }
}
