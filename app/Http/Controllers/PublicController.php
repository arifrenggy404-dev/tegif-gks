<?php
namespace App\Http\Controllers;

use App\Models\JadwalIbadahMinggu;
use App\Models\JadwalPelayananPa;
use App\Models\JadwalKesasi;
use App\Models\Wartamimbar;

class PublicController extends Controller
{
public function home()
{
    $ibadah = JadwalIbadahMinggu::with(['pelayan','pendamping'])
        ->where('waktu','>=',now())->orderBy('waktu')->take(3)->get();

    $pa = JadwalPelayananPa::with(['wilayah','pelayan','pendamping'])
        ->where('waktu','>=',now())->orderBy('waktu')->take(3)->get();

    $kesasi = JadwalKesasi::with('pengajar')
        ->where('waktu','>=',now())->orderBy('waktu')->take(3)->get();

    $warta = Wartamimbar::with(['ibadah','pelayananPa'])
        ->orderByDesc('tanggal')->take(3)->get();

    return view('public.home', compact('ibadah','pa','kesasi','warta'));
}

    public function jadwalIbadah()
    {
        $jadwal = JadwalIbadahMinggu::with(['pelayan','pendamping'])->orderByDesc('waktu')->paginate(10);
        return view('public.jadwal-ibadah', compact('jadwal'));
    }

    public function jadwalPa()
    {
        $jadwal = JadwalPelayananPa::with(['wilayah','pelayan','pendamping'])->orderByDesc('waktu')->paginate(10);
        return view('public.jadwal-pa', compact('jadwal'));
    }

    public function jadwalKesasi()
    {
        $jadwal = JadwalKesasi::with('pengajar')->orderByDesc('waktu')->paginate(10);
        return view('public.jadwal-kesasi', compact('jadwal'));

    }

    public function wartamimbar()
    {
        $warta = Wartamimbar::with(['ibadah','pelayananPa'])->orderByDesc('tanggal')->paginate(10);
        return view('public.wartamimbar', compact('warta'));
    }
}
