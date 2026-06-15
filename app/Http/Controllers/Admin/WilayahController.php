<?php
namespace App\Http\Controllers\Admin;

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

    return view('admin.wilayah.index', compact('wilayah'));
}

    public function create()
    {
        return view('admin.wilayah.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_wilayah' => 'required|string|max:100|unique:wilayah,nama_wilayah']);
        Wilayah::create($request->only('nama_wilayah'));
        return redirect()->route('admin.wilayah.index')->with('success', 'Wilayah berhasil ditambahkan.');
    }

    public function edit(Wilayah $wilayah)
    {
        return view('admin.wilayah.edit', compact('wilayah'));
    }

    public function update(Request $request, Wilayah $wilayah)
    {
        $request->validate(['nama_wilayah' => 'required|string|max:100|unique:wilayah,nama_wilayah,'.$wilayah->id_wilayah.',id_wilayah']);
        $wilayah->update($request->only('nama_wilayah'));
        return redirect()->route('admin.wilayah.index')->with('success', 'Wilayah diperbarui.');
    }

    public function destroy(Wilayah $wilayah)
    {
        // Bungkus dalam Database Transaction agar jika salah satu gagal, data tidak rusak/pincang
        DB::transaction(function () use ($wilayah) {
            
            // 1. Ambil semua id_pelayanan_pa yang terikat dengan id_wilayah ini
            $idJadwalPa = DB::table('jadwal_pelayanan_pa')
                ->where('id_wilayah', $wilayah->id_wilayah)
                ->pluck('id_pelayanan_pa');

            // 2. Jika ada jadwal PA yang ditemukan, hapus warta mimbar yang mengikat jadwal tersebut terlebih dahulu
            if ($idJadwalPa->isNotEmpty()) {
                DB::table('wartamimbar')
                    ->whereIn('id_pelayanan_pa', $idJadwalPa)
                    ->delete();
            }

            // 3. Hapus semua data di tabel jadwal_pelayanan_pa untuk wilayah ini
            DB::table('jadwal_pelayanan_pa')
                ->where('id_wilayah', $wilayah->id_wilayah)
                ->delete();

            // 4. Terakhir, hapus data wilayah utama
            $wilayah->delete();
        });

        return redirect()->route('admin.wilayah.index')
            ->with('success', 'Wilayah, Jadwal PA, beserta Warta Mimbar terkait telah otomatis dihapus secara bersih!');
    }
    /**
 * Menangani jika rute GET admin/wilayah/{id} diakses secara tidak sengaja.
 */
public function show(Wilayah $wilayah)
{
    // Alihkan langsung kembali ke halaman utama dengan pesan info
    return redirect()->route('admin.wilayah.index');
}
}