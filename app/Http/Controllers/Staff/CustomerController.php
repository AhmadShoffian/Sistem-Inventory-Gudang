<?php

namespace App\Http\Controllers\Staff;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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


}
