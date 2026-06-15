<?php
namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Jemaat;
use App\Models\Pelayan;
use App\Models\Wilayah;
use App\Models\AssetGereja;
use App\Models\JadwalIbadahMinggu;
use App\Models\JadwalPelayananPa;
use App\Models\JadwalKesasi;
use App\Models\Wartamimbar;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Statistik ringkas ──────────────────────────
        $totalJemaat   = Jemaat::count();
        $pelayanAktif  = Pelayan::where('aktif', true)->count();
        $totalWilayah  = Wilayah::count();
        $totalAsset    = AssetGereja::count();

        // ── Jadwal Ibadah Minggu terdekat ──────────────
        $ibadahMendatang = JadwalIbadahMinggu::with(['pelayan', 'pendamping'])
            ->where('waktu', '>=', now())
            ->orderBy('waktu')
            ->limit(3)
            ->get();

        // ── Jadwal PA terdekat ──────────────────────────
        $paMendatang = JadwalPelayananPa::with(['pelayan', 'pendamping', 'wilayah'])
            ->where('waktu', '>=', now())
            ->orderBy('waktu')
            ->limit(3)
            ->get();

        // ── Jadwal Kesasi terdekat ──────────────────────
        $kesasiMendatang = JadwalKesasi::with('pengajar')
            ->where('waktu', '>=', now())
            ->orderBy('waktu')
            ->limit(3)
            ->get();

        // ── Warta Mimbar terbaru ─────────────────────────
        $wartaTerbaru = Wartamimbar::with(['user', 'ibadah', 'pelayananPa'])
            ->orderByDesc('tanggal')
            ->limit(5)
            ->get();

        return view('pengurus.dashboard', compact(
            'totalJemaat',
            'pelayanAktif',
            'totalWilayah',
            'totalAsset',
            'ibadahMendatang',
            'paMendatang',
            'kesasiMendatang',
            'wartaTerbaru',
        ));
    }
}
