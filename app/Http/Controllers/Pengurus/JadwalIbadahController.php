<?php
namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\JadwalIbadahMinggu;
use App\Models\Pelayan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalIbadahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = JadwalIbadahMinggu::with(['pelayan', 'pendamping']);

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('lokasi', 'LIKE', '%' . $search . '%')
                  ->orWhere('ayat_bacaan', 'LIKE', '%' . $search . '%')
                  ->orWhere('tema', 'LIKE', '%' . $search . '%');
            });
        }

        $jadwal = $query->orderBy('waktu', 'asc')->paginate(10);

        return view('pengurus.jadwal-ibadah.index', compact('jadwal'));
    }
    public function show(JadwalIbadahMinggu $jadwalIbadah)
{
    $jadwalIbadah->load(['pelayan', 'pendamping']);
    return view('pengurus.jadwal-ibadah.show', compact('jadwalIbadah'));
}

    
}
