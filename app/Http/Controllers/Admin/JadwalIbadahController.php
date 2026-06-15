<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalIbadahMinggu;
use App\Models\Pelayan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalIbadahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = JadwalIbadahMinggu::with(['pelayan', 'pendamping']);

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('lokasi', 'LIKE', '%' . $search . '%')
                  ->orWhere('ayat_bacaan', 'LIKE', '%' . $search . '%')
                  ->orWhere('tema', 'LIKE', '%' . $search . '%');
            });
        }

        $jadwal = $query->orderBy('waktu', 'asc')->paginate(10);

        return view('admin.jadwal-ibadah.index', compact('jadwal'));
    }
    public function show(JadwalIbadahMinggu $jadwalIbadah)
{
    $jadwalIbadah->load(['pelayan', 'pendamping']);
    return view('admin.jadwal-ibadah.show', compact('jadwalIbadah'));
}

    public function create()
    {
        $pelayan = Pelayan::aktif()->orderBy('nama_pelayan')->get();
        return view('admin.jadwal-ibadah.create', compact('pelayan'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        JadwalIbadahMinggu::create($validated + ['id_user' => Auth::id()]);

        return redirect()->route('admin.jadwal-ibadah.index')->with('success', 'Jadwal ibadah ditambahkan.');
    }

    public function edit(JadwalIbadahMinggu $jadwalIbadah)
    {
        $pelayan = Pelayan::aktif()->orderBy('nama_pelayan')->get();
        return view('admin.jadwal-ibadah.edit', compact('jadwalIbadah', 'pelayan'));
    }

    public function update(Request $request, JadwalIbadahMinggu $jadwalIbadah)
    {
        $validated = $this->validateData($request);

        $jadwalIbadah->update($validated);

        return redirect()->route('admin.jadwal-ibadah.index')->with('success', 'Jadwal diperbarui.');
    }

    public function destroy(JadwalIbadahMinggu $jadwalIbadah)
    {
        $jadwalIbadah->delete();
        return redirect()->route('admin.jadwal-ibadah.index')->with('success', 'Jadwal dihapus.');
    }

    /**
     * Aturan validasi untuk store & update
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'id_pelayan'          => 'required|exists:pelayan,id_pelayan',
            'id_pendamping'       => 'required|exists:pelayan,id_pelayan',
            'tema'                => 'nullable|string|max:150',
            'ayat_bacaan'         => 'required|string|max:100',
            'nats_pembimbing'     => 'nullable|string|max:100',
            'ayat_firman'         => 'nullable|string|max:100',
            'berita_anugerah'     => 'nullable|string',
            'petunjuk_hidup_baru' => 'nullable|string',
            'waktu'               => 'required|date',
            'lokasi'              => 'required|string|max:150',
        ]);
    }
}
