@extends('layouts.admin')
@section('title','Jadwal PA')
@section('content')

<div class="max-w-full overflow-x-hidden px-1 py-2">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-stone-800">Jadwal Pelayanan PA</h2>
            <p class="text-stone-500 text-sm">Total {{ $jadwal->total() }} jadwal PA terdaftar</p>
        </div>

        <div class="flex gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.jadwal-pa.create') }}"
               class="inline-flex items-center justify-center bg-[#143222] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#1b442e] transition shadow-sm flex-1 sm:flex-none text-center transform hover:-translate-y-0.5 duration-150">
                + Tambah Jadwal PA
            </a>

            <a href="{{ route('admin.jadwal-pa.print-pdf', ['wilayah_id' => request('wilayah_id')]) }}"
               target="_blank"
               class="inline-flex items-center justify-center bg-amber-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-amber-700 transition shadow-sm flex-1 sm:flex-none cursor-pointer">
                Print PDF
            </a>
        </div>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Pencarian --}}
    <div class="bg-white p-4 rounded-2xl border border-stone-200 mb-5 shadow-sm">
        <form action="{{ route('admin.jadwal-pa.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari berdasarkan nama penerima PA atau wilayah..."
                       class="w-full pl-10 pr-4 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 font-medium transition-all shadow-sm">
            </div>

            <div class="flex-1 sm:flex-none">
                <select name="wilayah_id"
                        class="w-full px-4 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 font-medium transition-all shadow-sm bg-white"
                        onchange="this.form.submit()">
                    <option value="">📍 Semua Lingkungan/Wilayah</option>
                    @foreach($wilayahs as $w)
                        <option value="{{ $w->id_wilayah }}" {{ request('wilayah_id') == $w->id_wilayah ? 'selected' : '' }}>
                            {{ $w->nama_wilayah }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 sm:flex-none bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-800 transition shadow-sm cursor-pointer">
                    Cari
                </button>

                @if(request('search') || request('wilayah_id'))
                    <a href="{{ route('admin.jadwal-pa.index') }}" class="flex-1 sm:flex-none bg-stone-100 text-stone-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-stone-200 transition border border-stone-300 flex items-center justify-center shadow-sm">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Tabel Jadwal PA --}}
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#143222] text-white">
                        <th class="px-4 py-3 text-left font-semibold">No</th>
                        <th class="px-4 py-3 text-left font-semibold">Waktu</th>
                        <th class="px-4 py-3 text-left font-semibold">Penerima PA</th>
                        <th class="px-4 py-3 text-left font-semibold">Pelayan</th>
                        <th class="px-4 py-3 text-left font-semibold">Pendamping</th>
                        <th class="px-4 py-3 text-left font-semibold">Lingkungan/Wilayah</th>
                        <th class="px-4 py-3 text-left font-semibold">Nats / Ayat</th>
                        <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($jadwal as $index => $j)
                        <tr class="hover:bg-stone-50 transition">
                            <td class="px-4 py-3 text-stone-600">
                                {{ $jadwal->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-3 text-stone-700 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($j->waktu)->translatedFormat('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-3 text-stone-800 font-medium">
                                {{ $j->nama_penerima_pa }}
                            </td>
                            <td class="px-4 py-3 text-stone-700">
                                {{ $j->pelayan->nama_pelayan ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-stone-700">
                                {{ $j->pendamping->nama_pelayan ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-stone-700">
                                {{ $j->wilayah->nama_wilayah ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-stone-700 max-w-xs truncate" title="{{ $j->ayat }}">
                                {{ $j->ayat }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.jadwal-pa.edit', $j->id_pelayanan_pa ?? $j->id) }}"
                                       class="inline-flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.jadwal-pa.destroy', $j->id_pelayanan_pa ?? $j->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal PA ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center justify-center bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-lg text-xs font-semibold transition cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-10 text-center text-stone-500">
                                Tidak ada data jadwal PA ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($jadwal->hasPages())
        <div class="mt-4">
            {{ $jadwal->links() }}
        </div>
    @endif

</div>

@endsection
