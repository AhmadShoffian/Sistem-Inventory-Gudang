<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\LaporanSkpd;
use App\Models\Skpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\LaporanSkpdExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanSkpdController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $laporans = LaporanSkpd::with('skpd')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('staff.laporan-skpd.index', compact('laporans', 'bulan', 'tahun'));
    }


    public function create()
    {
        $skpds = Skpd::where('jumlah_sisa', '>', 0)
                    ->orderBy('tanggal_masuk', 'asc')
                    ->get();

        return view('staff.laporan-skpd.create', compact('skpds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skpd_id' => 'required|exists:skpds,id',
            'tanggal' => 'required|date',
            'lokasi_penggunaan' => 'required|in:samsat_keliling,kantor,alat_berat',
            'penggunaan_lembar' => 'required|integer|min:1',
            'penggunaan_noseri' => 'required|string',
            'jumlah_rusak' => 'nullable|integer|min:0',
            'rusak_noseri' => 'nullable|string',
            'penambahan' => 'nullable|integer|min:0',
            'penambahan_noseri' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $skpd = Skpd::findOrFail($request->skpd_id);

            // Hitung jumlah sisa baru
            $sisaBaru = $skpd->jumlah_sisa - $request->penggunaan_lembar + ($request->penambahan ?? 0) * 500;

            if ($sisaBaru < 0) {
                return back()->withInput()->withErrors([
                    'penggunaan_lembar' => 'Jumlah pemakaian melebihi sisa yang tersedia (maksimal '. $skpd->jumlah_sisa .' lembar).'
                ]);
            }

            // Simpan laporan
            LaporanSkpd::create([
                ...$request->only([
                    'skpd_id', 'tanggal', 'lokasi_penggunaan',
                    'penggunaan_lembar', 'penggunaan_noseri',
                    'jumlah_rusak', 'rusak_noseri',
                    'penambahan', 'penambahan_noseri'
                ]),
                'jumlah_sisa_harian' => $sisaBaru,
            ]);

            // Update jumlah sisa di skpd
            $skpd->update(['jumlah_sisa' => $sisaBaru]);
        });

        return redirect()->route('staff.laporan-skpd.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function export(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        Carbon::setLocale('id');
        $namaBulan = $bulan ? Carbon::createFromDate(null, $bulan, null)->translatedFormat('F') : '';

        $query = LaporanSkpd::with('skpd')->orderBy('tanggal', 'asc');

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        $laporans = $query->get();

        return Excel::download(
            new LaporanSkpdExport($laporans, $namaBulan, $tahun),
            'Laporan_SKPD_' . now()->format('Y_m_d_His') . '.xlsx'
        );
    }
}
