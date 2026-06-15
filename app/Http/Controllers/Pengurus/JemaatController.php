<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Jemaat;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class JemaatController extends Controller
{


    public function index(Request $request)
    {
        $search = $request->input('search');

        // Memulai query jemaat
        $query = Jemaat::with('wilayah');

        // JIKA kolom pencarian diisi oleh admin
        if (!empty($search)) {
            // Hanya ambil data yang nama_jemaat-nya mengandung kata kunci yang diketik
            $query->where('nama_jemaat', 'LIKE', '%' . $search . '%');
        }

        // Mengambil hasil data yang sudah difilter (misal: 10 data per halaman)
        $jemaat = $query->latest()->paginate(10);

        return view('pengurus.jemaat.index', compact('jemaat'));
    }
    public function show(Jemaat $jemaat)
    {
        $jemaat->load('wilayah');
        return view('pengurus.jemaat.show', compact('jemaat'));
    }

}
