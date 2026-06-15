<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Keuangan::with('user')->orderByDesc('tanggal_transaksi');

        // Filter jenis
        if ($request->filled('jenis')) {
            $query->where('jenis_transaksi', $request->jenis);
        }

        // Filter bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_transaksi', date('m', strtotime($request->bulan)))
                  ->whereYear('tanggal_transaksi',  date('Y', strtotime($request->bulan)));
        }

        $transaksi        = $query->paginate(15)->withQueryString();
        $totalPemasukan   = Keuangan::pemasukan()->sum('total');
        $totalPengeluaran = Keuangan::pengeluaran()->sum('total');
        $saldo            = $totalPemasukan - $totalPengeluaran;

        return view('bendahara.keuangan.index', compact(
            'transaksi', 'totalPemasukan', 'totalPengeluaran', 'saldo'
        ));
    }

    public function create()
    {
        return view('bendahara.keuangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_transaksi'   => 'required|in:pemasukan,pengeluaran',
            'tanggal_transaksi' => 'required|date',
            'total'             => 'required|numeric|min:0',
            'keterangan'        => 'nullable|string|max:255',
        ]);

        Keuangan::create([
            'id_user'           => Auth::id(),
            'jenis_transaksi'   => $request->jenis_transaksi,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'total'             => $request->total,
            'keterangan'        => $request->keterangan,
        ]);

        return redirect()->route('bendahara.keuangan.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    public function edit(Keuangan $keuangan)
    {
        return view('bendahara.keuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'jenis_transaksi'   => 'required|in:pemasukan,pengeluaran',
            'tanggal_transaksi' => 'required|date',
            'total'             => 'required|numeric|min:0',
            'keterangan'        => 'nullable|string|max:255',
        ]);

        $keuangan->update([
            'jenis_transaksi'   => $request->jenis_transaksi,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'total'             => $request->total,
            'keterangan'        => $request->keterangan,
        ]);

        return redirect()->route('bendahara.keuangan.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();
        return redirect()->route('bendahara.keuangan.index')
            ->with('success', 'Transaksi dihapus.');
    }
}