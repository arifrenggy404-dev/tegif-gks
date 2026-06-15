<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        $totalPemasukan = Keuangan::pemasukan()
            ->whereMonth('tanggal_transaksi', $bulanIni)
            ->whereYear('tanggal_transaksi', $tahunIni)
            ->sum('total');

        $totalPengeluaran = Keuangan::pengeluaran()
            ->whereMonth('tanggal_transaksi', $bulanIni)
            ->whereYear('tanggal_transaksi', $tahunIni)
            ->sum('total');

        $saldo = $totalPemasukan - $totalPengeluaran;

        $transaksiTerbaru = Keuangan::with('user')
            ->orderByDesc('tanggal_transaksi')
            ->take(5)
            ->get();

        // Data grafik 6 bulan terakhir
        $grafik = collect(range(5, 0))->map(function ($i) {
            $bulan = now()->subMonths($i);
            return [
                'bulan'       => $bulan->isoFormat('MMM YY'),
                'pemasukan'   => Keuangan::pemasukan()
                    ->whereMonth('tanggal_transaksi', $bulan->month)
                    ->whereYear('tanggal_transaksi', $bulan->year)
                    ->sum('total'),
                'pengeluaran' => Keuangan::pengeluaran()
                    ->whereMonth('tanggal_transaksi', $bulan->month)
                    ->whereYear('tanggal_transaksi', $bulan->year)
                    ->sum('total'),
            ];
        });

        return view('bendahara.dashboard', compact(
            'totalPemasukan', 'totalPengeluaran', 'saldo',
            'transaksiTerbaru', 'grafik'
        ));
    }
}