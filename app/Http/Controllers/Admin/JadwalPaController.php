<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelayananPa;
use App\Models\Jemaat;
use App\Models\Pelayan;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class JadwalPaController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $wilayahId = $request->input('wilayah_id');

        $query = JadwalPelayananPa::query()->with(['pelayan', 'pendamping', 'wilayah']);

        if (!empty($wilayahId)) {
            $query->where('id_wilayah', $wilayahId);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_penerima_pa', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('wilayah', function ($w) use ($search) {
                      $w->where('nama_wilayah', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        $jadwal = $query->orderBy('waktu', 'asc')->paginate(10);
        $wilayahs = Wilayah::orderBy('nama_wilayah', 'asc')->get();

        return view('admin.jadwal-pa.index', compact('jadwal', 'wilayahs'));
    }

    public function create()
    {
        $wilayah = Wilayah::all();
        $pelayan = Pelayan::where('aktif', true)->get();
        $jemaat = Jemaat::orderBy('nama_jemaat', 'asc')->get();

        return view('admin.jadwal-pa.create', compact('wilayah', 'pelayan', 'jemaat'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'waktu' => 'required|date',
            'nama_penerima_pa' => 'required|string|max:255',
            'id_pelayan' => 'required|exists:pelayan,id_pelayan',
            'id_pendamping' => 'required|exists:pelayan,id_pelayan',
            'id_wilayah' => 'required|exists:wilayah,id_wilayah',
            'ayat' => 'required|string|max:255',
        ], [
            'nama_penerima_pa.required' => 'Nama penerima PA wajib diisi.',
            'ayat.required' => 'Nats / Ayat Alkitab wajib diisi.',
        ]);

        $validatedData['id_user'] = $request->user()->id_user;

        JadwalPelayananPa::create($validatedData);

        return redirect()->route('admin.jadwal-pa.index')
            ->with('success', 'Jadwal pelayanan PA baru berhasil ditambahkan!');
    }

    public function edit($id): View
    {
        $jadwal = JadwalPelayananPa::findOrFail($id);
        $pelayan = Pelayan::where('aktif', true)->get();
        $wilayah = Wilayah::all();

        return view('admin.jadwal-pa.edit', compact('jadwal', 'pelayan', 'wilayah'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'waktu' => 'required|date',
            'nama_penerima_pa' => 'required|string|max:255',
            'id_pelayan' => 'required|exists:pelayan,id_pelayan',
            'id_pendamping' => 'required|exists:pelayan,id_pelayan',
            'id_wilayah' => 'required|exists:wilayah,id_wilayah',
            'ayat' => 'required|string|max:255',
        ], [
            'nama_penerima_pa.required' => 'Nama penerima PA wajib diisi.',
            'ayat.required' => 'Nats / Ayat Alkitab wajib diisi.',
        ]);

        $jadwal = JadwalPelayananPa::findOrFail($id);
        $jadwal->update($validatedData);

        return redirect()->route('admin.jadwal-pa.index')
            ->with('success', 'Jadwal pelayanan PA berhasil diperbarui!');
    }

    public function destroy($id): RedirectResponse
    {
        DB::transaction(function () use ($id) {
            DB::table('wartamimbar')->where('id_pelayanan_pa', $id)->delete();
            JadwalPelayananPa::findOrFail($id)->delete();
        });

        return redirect()->route('admin.jadwal-pa.index')
            ->with('success', 'Jadwal pelayanan PA beserta data warta terkait berhasil dihapus secara bersih!');
    }

    public function printPdf(Request $request)
    {
        $wilayahId = $request->input('wilayah_id');

        $query = JadwalPelayananPa::query()->with(['pelayan', 'pendamping', 'wilayah']);

        $wilayahName = 'Semua Wilayah';

        if (!empty($wilayahId)) {
            $query->where('id_wilayah', $wilayahId);
            $wilayahData = Wilayah::findOrFail($wilayahId);
            $wilayahName = $wilayahData->nama_wilayah;
        }

        $jadwal = $query->orderBy('waktu', 'asc')->get();

        $pdf = Pdf::loadView('admin.jadwal-pa.pdf', [
            'jadwal' => $jadwal,
            'wilayahName' => $wilayahName,
        ]);

        return $pdf->stream('jadwal-pa-' . str_replace(' ', '-', strtolower($wilayahName)) . '.pdf');
    }
}
