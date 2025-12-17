<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Pengadaan;
use App\Models\KerusakanBarang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengadaanExport;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $pembelian = Pengadaan::whereNotNull('harga_satuan')
            ->whereMonth('tanggal_pengadaan', $bulan)
            ->whereYear('tanggal_pengadaan', $tahun)
            ->get();

        $totalPengadaan = $pembelian->sum(fn($b) => $b->jumlah * $b->harga_satuan);

        $perbaikan = KerusakanBarang::where('kondisi', 'baik')
            ->whereNotNull('biaya_perbaikan')
            ->whereMonth('updated_at', $bulan)
            ->whereYear('updated_at', $tahun)
            ->get();

        $totalPerbaikan = $perbaikan->sum('biaya_perbaikan');
        $totalKeseluruhan = $totalPengadaan + $totalPerbaikan;

        return view('staff.report.index', compact(
            'pembelian',
            'perbaikan',
            'totalPengadaan',
            'totalPerbaikan',
            'totalKeseluruhan',
            'bulan',
            'tahun'
        ));
    }

    public function export(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        Carbon::setLocale('id');
        $namaBulan = Carbon::createFromDate(null, $bulan, null)->translatedFormat('F');

        $pembelian = Pengadaan::whereNotNull('harga_satuan')
            ->whereMonth('tanggal_pengadaan', $bulan)
            ->whereYear('tanggal_pengadaan', $tahun)
            ->get();

        $totalPengadaan = $pembelian->sum(fn($b) => $b->jumlah * $b->harga_satuan);

        $perbaikan = KerusakanBarang::where('kondisi', 'baik')
            ->whereNotNull('biaya_perbaikan')
            ->whereMonth('updated_at', $bulan)
            ->whereYear('updated_at', $tahun)
            ->get();

        $totalPerbaikan = $perbaikan->sum('biaya_perbaikan');
        $totalKeseluruhan = $totalPengadaan + $totalPerbaikan;

        return Excel::download(
            new PengadaanExport($pembelian, $perbaikan, $totalPengadaan, $totalPerbaikan, $totalKeseluruhan, $bulan, $tahun, $namaBulan),
            'Laporan_Pengeluaran_' . now()->format('Ym') . '.xlsx'
        );
    }
}
