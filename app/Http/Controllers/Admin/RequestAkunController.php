<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\AkunDisetujuiMail;

class RequestAkunController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = DB::table('requests');
        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        $requests = $query->get();


        $jumlahRequestPending = DB::table('requests')->where('status', 'pending')->count();
        $jumlahRequestApproved = DB::table('requests')->where('status', 'approved')->count();
        $jumlahRequestRejected = DB::table('requests')->where('status', 'rejected')->count();
        $jumlahStaff = User::where('role', 'staff')->count();

        return view('admin.request-index', compact(
            'requests',
            'status',
            'jumlahRequestPending',
            'jumlahRequestApproved',
            'jumlahRequestRejected',
            'jumlahStaff'
        ));
    }

    public function create()
    {
        return view('auth.request-akun');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'nip'           => 'required|string|max:50|unique:requests,nip',
            'jabatan'       => 'required|string|max:100',
            'unit_kerja'    => 'required|string',
            'email'         => 'required|email|unique:requests,email',
        ]);

        DB::table('requests')->insert([
            'nama'          => $request->nama,
            'nip'           => $request->nip,
            'jabatan'       => $request->jabatan,
            'unit_kerja'    => $request->unit_kerja,
            'email'         => $request->email,
            'status'        => 'pending',
            'created_at'    => now(),
        ]);

        return redirect()->route('request-akun.form')->with('success', 'Permintaan akun berhasil dikirim. Tunggu verifikasi dari admin.');
    }

    public function approve($id)
    {
        $request = DB::table('requests')->where('id', $id)->first();

        if (!$request) {
            return redirect()->back()->with('error', 'Permintaan tidak ditemukan.');
        }

        $password = Str::random(10);

        // Buat akun staff (update ke table users)
        $user = User::create([
            'name'     => $request->nama,
            'nip'      => $request->nip,
            'email'    => $request->email,
            'password' => Hash::make($password),
            'jabatan'  => $request->jabatan,
            'instansi' => $request->instansi,
            'role'     => 'staff',
        ]);

        // Kirim email pemberitahuan ke user
        Mail::to($request->email)->send(new AkunDisetujuiMail($user, $password));

        // Update status di tabel requests agar tetap tersimpan
        DB::table('requests')->where('id', $id)->update([
            'status' => 'approved',
            'updated_at' => now()
        ]);

        return redirect()->route('admin.request.index')->with('success', 'Permintaan akun berhasil disetujui dan akun telah dibuat.');
    }

    public function reject($id)
    {
        $request = DB::table('requests')->where('id', $id)->first();

        if ($request) {
            Mail::to($request->email)->send(new \App\Mail\AkunDitolakMail($request->nama));

            DB::table('requests')->where('id', $id)->update([
                'status' => 'rejected',
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('admin.request.index')->with('success', 'Permintaan akun ditolak dan email telah dikirim.');
    }

}
