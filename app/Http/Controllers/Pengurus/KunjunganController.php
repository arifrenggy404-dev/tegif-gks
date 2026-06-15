<?php
namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungan = Kunjungan::with('wilayah')->orderByDesc('waktu_kunjungan')->paginate(10);
        return view('pengurus.kunjungan.index', compact('kunjungan'));
    }

    
}
