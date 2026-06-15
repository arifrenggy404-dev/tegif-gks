<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalKesasi;
use App\Models\Pelayan;
use Illuminate\Http\Request;

class JadwalKesasiController extends Controller
{
    public function index()
    {
        $jadwal = JadwalKesasi::with('pengajar')->orderByDesc('waktu')->paginate(10);
        return view('admin.jadwal-kesasi.index', compact('jadwal'));
    }

    public function create()
    {
        $pelayan = Pelayan::aktif()->orderBy('nama_pelayan')->get();
        return view('admin.jadwal-kesasi.create', compact('pelayan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pengajar' => 'required|exists:pelayan,id_pelayan',
            'waktu'       => 'required|date',
            'materi'      => 'required|string|max:200',
        ]);
        JadwalKesasi::create($request->all());
        return redirect()->route('admin.jadwal-kesasi.index')->with('success', 'Jadwal Kesasi ditambahkan.');
    }

    public function edit(JadwalKesasi $jadwalKesasi)
    {
        $pelayan = Pelayan::aktif()->orderBy('nama_pelayan')->get();
        return view('admin.jadwal-kesasi.edit', compact('jadwalKesasi', 'pelayan'));
    }

    public function update(Request $request, JadwalKesasi $jadwalKesasi)
    {
        $request->validate([
            'id_pengajar' => 'required|exists:pelayan,id_pelayan',
            'waktu'       => 'required|date',
            'materi'      => 'required|string|max:200',
        ]);
        $jadwalKesasi->update($request->all());
        return redirect()->route('admin.jadwal-kesasi.index')->with('success', 'Jadwal Kesasi diperbarui.');
    }

    public function destroy(JadwalKesasi $jadwalKesasi)
    {
        $jadwalKesasi->delete();
        return redirect()->route('admin.jadwal-kesasi.index')->with('success', 'Jadwal Kesasi dihapus.');
    }
}