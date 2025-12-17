<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahRequestPending = null;
        $jumlahRequestApproved = null;
        $jumlahRequestRejected = null;
        $jumlahStaff = null;
        $recentRequests = collect();

        if (Auth::check() && Auth::user()->role === 'admin') {
            $jumlahRequestPending = DB::table('requests')->where('status', 'pending')->count();
            $jumlahRequestApproved = DB::table('requests')->where('status', 'approved')->count();
            $jumlahRequestRejected = DB::table('requests')->where('status', 'rejected')->count();
            $jumlahStaff = User::where('role', 'staff')->count();

            $recentRequests = DB::table('requests')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }

        return view('admin.dashboard', compact(
            'jumlahRequestPending',
            'jumlahRequestApproved',
            'jumlahRequestRejected',
            'jumlahStaff',
            'recentRequests'
        ));
    }
}
