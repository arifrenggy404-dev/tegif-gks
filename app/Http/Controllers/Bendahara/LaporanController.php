<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    // Tampilkan form pilih periode
    public function index()
    {
        // Ambil daftar bulan yang ada transaksinya
        $periodeList = Keuangan::selectRaw('YEAR(tanggal_transaksi) as tahun, MONTH(tanggal_transaksi) as bulan')
            ->groupByRaw('YEAR(tanggal_transaksi), MONTH(tanggal_transaksi)')
            ->orderByRaw('tahun DESC, bulan DESC')
            ->get();

        // Rekap per tahun untuk dropdown
        $tahunList = Keuangan::selectRaw('YEAR(tanggal_transaksi) as tahun')
            ->groupByRaw('YEAR(tanggal_transaksi)')
            ->orderByRaw('tahun DESC')
            ->pluck('tahun');

        return view('bendahara.laporan.index', compact('periodeList', 'tahunList'));
    }

    // Preview laporan di browser
    public function preview(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string',
        ]);

        $data = $this->buildData($request->bulan);
        return view('bendahara.laporan.preview', $data);
    }

    // Download sebagai PDF
    public function download(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string',
        ]);

        $data = $this->buildData($request->bulan);

        $pdf = Pdf::loadView('bendahara.laporan.pdf', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont'     => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        $namaFile = 'Laporan-Keuangan-' . $data['bulanLabel'] . '-' . $data['tahun'] . '.pdf';

        return $pdf->download($namaFile);
    }

    // Stream (buka di tab baru)
    public function stream(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string',
        ]);

        $data = $this->buildData($request->bulan);

        $pdf = Pdf::loadView('bendahara.laporan.pdf', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont'         => 'sans-serif',
                'isHtml5ParserEnabled'=> true,
                'isRemoteEnabled'     => true,
            ]);

        $namaFile = 'Laporan-Keuangan-' . $data['bulanLabel'] . '-' . $data['tahun'] . '.pdf';

        return $pdf->stream($namaFile);
    }

    // ── Private helper ──────────────────────────────────
    private function buildData(string $periode): array
    {
        // $periode format: "2025-06"
        [$tahun, $bulan] = explode('-', $periode);

        $transaksi = Keuangan::with('user')
            ->whereYear('tanggal_transaksi', $tahun)
            ->whereMonth('tanggal_transaksi', $bulan)
            ->orderBy('tanggal_transaksi')
            ->orderBy('id_keuangan')
            ->get();

        $totalPemasukan   = $transaksi->where('jenis_transaksi', 'pemasukan')->sum('total');
        $totalPengeluaran = $transaksi->where('jenis_transaksi', 'pengeluaran')->sum('total');
        $saldo            = $totalPemasukan - $totalPengeluaran;

        // Saldo awal = semua transaksi sebelum bulan ini
        $saldoAwal = Keuangan::where('tanggal_transaksi', '<', $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '-01')
            ->selectRaw("SUM(CASE WHEN jenis_transaksi='pemasukan' THEN total ELSE -total END) as saldo")
            ->value('saldo') ?? 0;

        $saldoAkhir = $saldoAwal + $saldo;

        // Group per minggu
        $perMinggu = $transaksi->groupBy(function ($t) {
            return 'Minggu ke-' . ceil($t->tanggal_transaksi->day / 7);
        });

        $namaBulan = [
            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
            5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
            9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
        ];

        return [
            'transaksi'        => $transaksi,
            'perMinggu'        => $perMinggu,
            'totalPemasukan'   => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo'            => $saldo,
            'saldoAwal'        => $saldoAwal,
            'saldoAkhir'       => $saldoAkhir,
            'bulan'            => (int) $bulan,
            'tahun'            => (int) $tahun,
            'bulanLabel'       => $namaBulan[(int)$bulan],
            'periode'          => $periode,
            'dicetak'          => now()->isoFormat('dddd, D MMMM YYYY HH:mm'),
            'dicetakOleh'      => Auth::user()->nama,
        ];
    }
}