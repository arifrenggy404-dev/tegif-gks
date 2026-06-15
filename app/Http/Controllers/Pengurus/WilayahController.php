<?php
namespace App\Http\Controllers\Pengurus;
use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
   public function index(Request $request)
{
    $search = $request->input('search');

    // Menghitung jumlah jemaat terkait menggunakan withCount
    $query = Wilayah::withCount('jemaat');

    // Pencarian spesifik nama wilayah
    if (!empty($search)) {
        $query->where('nama_wilayah', 'LIKE', '%' . $search . '%');
    }

    $wilayah = $query->latest()->paginate(10);

    return view('pengurus.wilayah.index', compact('wilayah'));
}

    
}
