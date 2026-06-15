<?php
namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Pelayan;
use Illuminate\Http\Request;

class PelayanController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $query = Pelayan::query();

    // JIKA kolom pencarian diisi oleh admin
    if (!empty($search)) {
        // Hanya ambil data yang nama_pelayan-nya cocok dengan kata kunci
        $query->where('nama_pelayan', 'LIKE', '%' . $search . '%');
    }

    $pelayan = $query->latest()->paginate(10);

    return view('pengurus.pelayan.index', compact('pelayan'));
}

    
}
