<?php

namespace App\Http\Controllers\Staff;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();
        $customers = $query->get();
        if ($request->ajax()) {
            return view('staff.customer._table', compact('customers'))->render();
        }
        return view('staff.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('staff.customer.create');
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

        $customer = Customer::create([
            'name'                  => $request->name,
            'alamat'                => $request->alamat,
            'created_by_user_id'    => auth()->user()->id,
        ]);

        return redirect()
            ->route('staff.customer.index')
            ->with('success', 'Customer berhasil ditambahkan!');
    }

}
