<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wartamimbar;
use App\Models\JadwalIbadahMinggu;
use App\Models\JadwalPelayananPa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WartamimbarController extends Controller
{
    public function index()
    {
        $warta = Wartamimbar::with(['user','ibadah','pelayananPa'])->orderByDesc('tanggal')->paginate(10);
        return view('admin.wartamimbar.index', compact('warta'));
    }

    public function create()
    {
        $ibadah = JadwalIbadahMinggu::orderByDesc('waktu')->get();
        $pa     = JadwalPelayananPa::with('wilayah')->orderByDesc('waktu')->get();
        return view('admin.wartamimbar.create', compact('ibadah', 'pa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ibadah'        => 'required|exists:jadwal_ibadah_minggu,id_ibadah',
            'id_pelayanan_pa'  => 'required|exists:jadwal_pelayanan_pa,id_pelayanan_pa',
            'informasi'        => 'required|string',
            'tanggal'          => 'required|date',
        ]);
        Wartamimbar::create($request->all() + ['id_user' => Auth::id()]);
        return redirect()->route('admin.wartamimbar.index')->with('success', 'Warta Mimbar ditambahkan.');
    }

    public function edit(Wartamimbar $wartamimbar)
    {
        $ibadah = JadwalIbadahMinggu::orderByDesc('waktu')->get();
        $pa     = JadwalPelayananPa::with('wilayah')->orderByDesc('waktu')->get();
        return view('admin.wartamimbar.edit', compact('wartamimbar', 'ibadah', 'pa'));
    }

    public function update(Request $request, Wartamimbar $wartamimbar)
    {
        $request->validate([
            'id_ibadah'       => 'required|exists:jadwal_ibadah_minggu,id_ibadah',
            'id_pelayanan_pa' => 'required|exists:jadwal_pelayanan_pa,id_pelayanan_pa',
            'informasi'       => 'required|string',
            'tanggal'         => 'required|date',
        ]);
        $wartamimbar->update($request->all());
        return redirect()->route('admin.wartamimbar.index')->with('success', 'Warta Mimbar diperbarui.');
    }

    public function destroy(Wartamimbar $wartamimbar)
    {
        $wartamimbar->delete();
        return redirect()->route('admin.wartamimbar.index')->with('success', 'Warta Mimbar dihapus.');
    }
}