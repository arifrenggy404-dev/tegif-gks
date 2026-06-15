<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetGereja;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $asset = AssetGereja::orderBy('nama_aset')->paginate(15);
        return view('admin.asset.index', compact('asset'));
    }

    public function create()
    {
        return view('admin.asset.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_aset' => 'required|string|max:150',
            'jumlah'    => 'required|integer|min:1',
            'kondisi'   => 'required|in:layak,kurang_layak,tidak_layak',
        ]);
        AssetGereja::create($request->all());
        return redirect()->route('admin.asset.index')->with('success', 'Asset ditambahkan.');
    }

    public function edit(AssetGereja $asset)
    {
        return view('admin.asset.edit', compact('asset'));
    }

    public function update(Request $request, AssetGereja $asset)
    {
        $request->validate([
            'nama_aset' => 'required|string|max:150',
            'jumlah'    => 'required|integer|min:1',
            'kondisi'   => 'required|in:layak,kurang_layak,tidak_layak',
        ]);
        $asset->update($request->all());
        return redirect()->route('admin.asset.index')->with('success', 'Asset diperbarui.');
    }

    public function destroy(AssetGereja $asset)
    {
        $asset->delete();
        return redirect()->route('admin.asset.index')->with('success', 'Asset dihapus.');
    }
}