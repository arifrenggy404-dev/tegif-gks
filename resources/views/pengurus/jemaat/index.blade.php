@extends('layouts.pengurus')
@section('title','Data Jemaat')
@section('content')

<div class="max-w-full overflow-x-hidden px-1 py-2">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-stone-800">Data Jemaat</h2>
            <p class="text-stone-500 text-sm">Total {{ $jemaat->total() }} jemaat terdaftar</p>
        </div>
    </div>

    {{-- Filter Search Section --}}
    <div class="bg-white p-4 rounded-2xl border border-stone-200 mb-5 shadow-sm">
        <form action="{{ route('pengurus.jemaat.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari berdasarkan nama jemaat..."
                       class="w-full pl-10 pr-4 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 font-medium transition-all shadow-sm">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 sm:flex-none bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-800 transition shadow-sm cursor-pointer">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('pengurus.jemaat.index') }}" class="flex-1 sm:flex-none bg-stone-100 text-stone-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-stone-200 transition border border-stone-300 flex items-center justify-center shadow-sm">
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
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600">Nama</th>
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600">Wilayah</th>
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600 w-32">Status</th>
                    <th class="text-center px-5 py-3.5 font-bold text-stone-600 w-44">Aksi</th>
                </tr>
            </thead>

            <tbody class="block md:table-row-group space-y-3 md:space-y-0 divide-y divide-none md:divide-stone-100">
                @forelse($jemaat as $i => $j)
                <tr class="block md:table-row bg-white md:bg-transparent border border-stone-200 md:border-none rounded-2xl p-4 shadow-sm md:shadow-none hover:bg-stone-50/50 transition-colors duration-150">

                    <td class="hidden md:table-cell px-5 py-4 text-center text-stone-400 font-medium">
                        {{ $jemaat->firstItem() + $i }}
                    </td>

                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none pb-2 font-bold text-stone-800">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Nama</span>
                        <span class="text-right md:text-left">{{ $j->nama_jemaat }}</span>
                    </td>

                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2 text-stone-700 font-semibold">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Wilayah</span>
                        <span class="text-right md:text-left">{{ $j->wilayah->nama_wilayah }}</span>
                    </td>

                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Status</span>
                        <div>
                            @php
                                $statusColor = match($j->status_jemaat) {
                                    'aktif'       => 'bg-green-50 text-green-700 border-green-100',
                                    'tidak_aktif' => 'bg-stone-50 text-stone-500 border-stone-200',
                                    'pindah'      => 'bg-amber-50 text-amber-700 border-amber-100',
                                    'meninggal'   => 'bg-rose-50 text-rose-600 border-rose-100',
                                    default       => 'bg-stone-50 text-stone-500 border-stone-200',
                                };
                            @endphp
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border shadow-sm inline-block {{ $statusColor }}">
                                {{ ucfirst(str_replace('_', ' ', $j->status_jemaat)) }}
                            </span>
                        </div>
                    </td>
                    <td class="flex justify-end md:table-cell px-0 md:px-5 pt-3 md:py-3 text-center">
                        <div class="flex items-center justify-end md:justify-center gap-2 w-full sm:w-auto">
                            <a href="{{ route('pengurus.jemaat.show', $j) }}"
                               class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200 rounded-xl text-xs font-bold transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="block md:table-row bg-white border border-stone-200 md:border-none rounded-2xl p-8 text-center">
                    <td colspan="5" class="block md:table-cell py-12 text-stone-400">
                        <div class="max-w-sm mx-auto flex flex-col items-center">
                            <div class="w-14 h-14 bg-stone-100 rounded-full flex items-center justify-center text-xl mb-3 shadow-inner">🔍</div>
                            <h3 class="text-stone-700 font-bold text-base mb-0.5">Data Tidak Ditemukan</h3>
                            <p class="text-xs text-stone-400 px-4 mb-3">Tidak ditemukan catatan jemaat yang sesuai.</p>
                            @if(request('search'))
                                <a href="{{ route('admin.jemaat.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 border border-emerald-100 rounded-xl shadow-sm">
                                    Kembali lihat semua data →
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
        Menampilkan data jemaat terdaftar
    </span>
    <div class="shadow-sm rounded-xl overflow-hidden bg-white order-1 sm:order-2">
        {{ $jemaat->appends(request()->query())->links() }}
    </div>
</div>

@endsection
