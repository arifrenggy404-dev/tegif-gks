<?php
namespace App\Http\Controllers\Admin;

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

    return view('admin.pelayan.index', compact('pelayan'));
}

    public function create()
    {
        return view('admin.pelayan.create');
    }

    public function edit(Pelayan $pelayan)
    {
        return view('admin.pelayan.edit', compact('pelayan'));
    }

   public function store(Request $request)
{
    $request->validate([
        'nama_pelayan' => 'required|string|max:100',
        'jenis'        => 'required|in:pendeta,mejelis,vikaris', // ✅ samakan dengan enum
    ]);

    Pelayan::create([
        'nama_pelayan' => $request->nama_pelayan,
        'jenis'        => $request->jenis,
        'aktif'        => $request->boolean('aktif', true)
    ]);

    return redirect()->route('admin.pelayan.index')->with('success', 'Pelayan berhasil ditambahkan.');
}

public function update(Request $request, Pelayan $pelayan)
{
    $request->validate([
        'nama_pelayan' => 'required|string|max:100',
        'jenis'        => 'required|in:pendeta,mejelis,vikaris', // ✅ samakan dengan enum
    ]);
    $pelayan->update([
        'nama_pelayan' => $request->nama_pelayan,
        'jenis' => $request->jenis,
        'aktif' => $request->boolean('aktif')
    ]);
    return redirect()->route('admin.pelayan.index')->with('success', 'Data pelayan diperbarui.');
}
    public function destroy(Pelayan $pelayan)
    {
        $pelayan->delete();
        return redirect()->route('admin.pelayan.index')->with('success', 'Pelayan dihapus.');
    }
}
