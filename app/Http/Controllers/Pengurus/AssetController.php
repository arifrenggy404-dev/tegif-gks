<?php
namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\AssetGereja;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $asset = AssetGereja::orderBy('nama_aset')->paginate(15);
        return view('pengurus.asset.index', compact('asset'));
    }
}
