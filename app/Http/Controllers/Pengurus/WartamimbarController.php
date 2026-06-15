<?php
namespace App\Http\Controllers\Pengurus;

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
        return view('pengurus.wartamimbar.index', compact('warta'));
    }


}
