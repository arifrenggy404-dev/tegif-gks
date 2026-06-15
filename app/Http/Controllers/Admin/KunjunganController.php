<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungan = Kunjungan::with('wilayah')->orderByDesc('waktu_kunjungan')->paginate(10);
        return view('admin.kunjungan.index', compact('kunjungan'));
    }

    public function create()
    {
        $wilayah = Wilayah::orderBy('nama_wilayah')->get();
        return view('admin.kunjungan.create', compact('wilayah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tujuan'          => 'required|string',
            'waktu_kunjungan' => 'required|date',
            'id_wilayah'      => 'required|exists:wilayah,id_wilayah',
        ]);
        Kunjungan::create($request->all());
        return redirect()->route('admin.kunjungan.index')->with('success', 'Kunjungan ditambahkan.');
    }

    public function edit(Kunjungan $kunjungan)
    {
        $wilayah = Wilayah::orderBy('nama_wilayah')->get();
        return view('admin.kunjungan.edit', compact('kunjungan', 'wilayah'));
    }

    public function update(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'tujuan'          => 'required|string',
            'waktu_kunjungan' => 'required|date',
            'id_wilayah'      => 'required|exists:wilayah,id_wilayah',
        ]);
        $kunjungan->update($request->all());
        return redirect()->route('admin.kunjungan.index')->with('success', 'Kunjungan diperbarui.');
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();
        return redirect()->route('admin.kunjungan.index')->with('success', 'Kunjungan dihapus.');
    }
}