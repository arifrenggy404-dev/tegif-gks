@extends('layouts.admin')
@section('title', 'Jadwal Ibadah Minggu')
@section('content')

    <div class="max-w-full overflow-x-hidden px-1 py-2">
        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-stone-800">Jadwal Ibadah Minggu</h2>
                <p class="text-stone-500 text-sm">Total {{ $jadwal->total() }} jadwal ibadah terencana</p>
            </div>
            <a href="{{ route('admin.jadwal-ibadah.create') }}"
                class="inline-flex items-center justify-center bg-[#143222] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#1b442e] transition shadow-sm w-full sm:w-auto text-center transform hover:-translate-y-0.5 duration-150">
                + Tambah Jadwal
            </a>
        </div>

        {{-- Filter Search Section --}}
        <div class="bg-white p-4 rounded-2xl border border-stone-200 mb-5 shadow-sm">
            <form action="{{ route('admin.jadwal-ibadah.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan lokasi, tema, atau ayat bacaan..."
                        class="w-full pl-10 pr-4 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 font-medium transition-all shadow-sm">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="flex-1 sm:flex-none bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-800 transition shadow-sm cursor-pointer">
                        Cari
                    </button>
                    @if (request('search'))
                        <a href="{{ route('admin.jadwal-ibadah.index') }}"
                            class="flex-1 sm:flex-none bg-stone-100 text-stone-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-stone-200 transition border border-stone-300 flex items-center justify-center shadow-sm">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table / Cards Container --}}
        <div class="bg-transparent md:bg-white rounded-2xl md:border md:border-stone-200 overflow-hidden shadow-sm w-full">
            <table class="w-full text-sm block md:table">
                <thead class="bg-stone-50 border-b border-stone-200 hidden md:table-header-group">
                    <tr>
                        <th class="text-center px-5 py-3.5 font-bold text-stone-600 w-14">#</th>
                        <th class="text-left px-5 py-3.5 font-bold text-stone-600 w-40">Waktu</th>
                        <th class="text-left px-5 py-3.5 font-bold text-stone-600">Tema / Ayat Bacaan</th>
                        <th class="text-left px-5 py-3.5 font-bold text-stone-600">Pelayan</th>
                        <th class="text-left px-5 py-3.5 font-bold text-stone-600">Pendamping</th>
                        <th class="text-left px-5 py-3.5 font-bold text-stone-600 w-44">Lokasi</th>
                        <th class="text-center px-5 py-3.5 font-bold text-stone-600 w-40">Aksi</th>
                    </tr>
                </thead>

                <tbody class="block md:table-row-group space-y-3 md:space-y-0 divide-y divide-none md:divide-stone-100">
                    @forelse($jadwal as $i => $jadwalIbadah)
                        <tr
                            class="block md:table-row bg-white md:bg-transparent border border-stone-200 md:border-none rounded-2xl p-4 shadow-sm md:shadow-none hover:bg-stone-50/50 transition-colors duration-150">

                            <td class="hidden md:table-cell px-5 py-4 text-center text-stone-400 font-medium">
                                {{ $jadwal->firstItem() + $i }}
                            </td>

                            <td
                                class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none pb-2">
                                <span
                                    class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Waktu</span>
                                <div class="text-right md:text-left">
                                    <span
                                        class="font-semibold text-stone-800">{{ $jadwalIbadah->waktu->format('d M Y') }}</span>
                                    <span
                                        class="block text-xs font-bold text-emerald-700 md:text-stone-500 md:mt-0.5">{{ $jadwalIbadah->waktu->format('H:i') }}
                                        WITA</span>
                                </div>
                            </td>

                            <td
                                class="flex justify-between items-start md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2 max-w-xs">
                                <span
                                    class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden text-left mr-4">Tema
                                    / Bacaan</span>
                                <div class="text-right md:text-left">
                                    @if ($jadwalIbadah->tema)
                                        <span class="block font-semibold text-stone-800">{{ $jadwalIbadah->tema }}</span>
                                    @endif
                                    <span
                                        class="block text-xs text-stone-500 italic">{{ $jadwalIbadah->ayat_bacaan }}</span>
                                </div>
                            </td>

                            <td
                                class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2 font-medium text-stone-800">
                                <span
                                    class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Pelayan</span>
                                <span class="text-right md:text-left">{{ $jadwalIbadah->pelayan->nama_pelayan }}</span>
                            </td>

                            <td
                                class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2 text-stone-600">
                                <span
                                    class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Pendamping</span>
                                <span class="text-right md:text-left">{{ $jadwalIbadah->pendamping->nama_pelayan }}</span>
                            </td>

                            <td
                                class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2">
                                <span
                                    class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Lokasi</span>
                                <div>
                                    <span
                                        class="bg-stone-100 text-stone-700 px-2.5 py-0.5 rounded-full text-xs font-bold border border-stone-200 shadow-sm inline-block">
                                        {{ $jadwalIbadah->lokasi }}
                                    </span>
                                </div>
                            </td>

                            <td class="flex justify-end md:table-cell px-0 md:px-5 pt-3 md:py-3 text-center">
                                <div class="flex items-center justify-end md:justify-center gap-2 w-full sm:w-auto">

                                    <a href="{{ route('admin.jadwal-ibadah.show', $jadwalIbadah) }}"
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200 rounded-xl text-xs font-bold transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat
                                    </a>

                                    <a href="{{ route('admin.jadwal-ibadah.edit', $jadwalIbadah) }}"
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200 rounded-xl text-xs font-bold transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.jadwal-ibadah.destroy', $jadwalIbadah) }}" method="POST"
                                        class="flex-1 sm:flex-none inline-block m-0"
                                        onsubmit="return confirm('Hapus jadwal ini?')">
                                        @csrf
                                       @method('DELETE')
                                        <button type="submit"
                                            class="w-full inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 rounded-xl text-xs font-bold transition-all shadow-sm cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr
                            class="block md:table-row bg-white border border-stone-200 md:border-none rounded-2xl p-8 text-center">
                            <td colspan="7" class="block md:table-cell py-12 text-stone-400">
                                <div class="max-w-sm mx-auto flex flex-col items-center">
                                    <div
                                        class="w-14 h-14 bg-stone-100 rounded-full flex items-center justify-center text-xl mb-3 shadow-inner">
                                        🔍</div>
                                    <h3 class="text-stone-700 font-bold text-base mb-0.5">Jadwal Tidak Ditemukan</h3>
                                    <p class="text-xs text-stone-400 px-4 mb-3">Tidak ditemukan catatan rencana jadwal
                                        ibadah minggu yang sesuai.</p>
                                    @if (request('search'))
                                        <a href="{{ route('admin.jadwal-ibadah.index') }}"
                                            class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 border border-emerald-100 rounded-xl shadow-sm">
                                            Kembali lihat semua jadwal →
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination Footer --}}
    <div class="mt-5 flex flex-col sm:flex-row items-center justify-between gap-4 px-1">
        <span class="text-xs text-stone-400 font-medium order-2 sm:order-1">
            Menampilkan data perencanaan ibadah minggu jemaat
        </span>
        <div class="shadow-sm rounded-xl overflow-hidden bg-white order-1 sm:order-2">
            {{ $jadwal->appends(request()->query())->links() }}
        </div>
    </div>

@endsection
