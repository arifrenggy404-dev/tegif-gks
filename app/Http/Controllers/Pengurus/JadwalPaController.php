<?php

namespace App\Http\Controllers\Pengurus;

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
/** @var \App\Models\User $user */



class JadwalPaController extends Controller
{
    /**
     * Menampilkan daftar jadwal PA dengan fitur pencarian akurat
     */
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

        return view('pengurus.jadwal-pa.index', compact('jadwal', 'wilayahs'));
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

        $pdf = Pdf::loadView('pengurus.jadwal-pa.pdf', [
            'jadwal' => $jadwal,
            'wilayahName' => $wilayahName,
        ]);

        return $pdf->stream('jadwal-pa-' . str_replace(' ', '-', strtolower($wilayahName)) . '.pdf');
    }

}
