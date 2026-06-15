<?php
namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\JadwalKesasi;
use App\Models\Pelayan;
use Illuminate\Http\Request;

class JadwalKesasiController extends Controller
{
    public function index()
    {
        $jadwal = JadwalKesasi::with('pengajar')->orderByDesc('waktu')->paginate(10);
        return view('pengurus.jadwal-kesasi.index', compact('jadwal'));
    }

    
}
