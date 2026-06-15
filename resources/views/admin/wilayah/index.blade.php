@extends('layouts.admin')
@section('title','Data Wilayah')
@section('content')

<div class="max-w-full overflow-x-hidden px-1 py-2">
    {{-- Header Section (Responsive Stack) --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-stone-800">Data Wilayah</h2>
            <p class="text-stone-500 text-sm">Total {{ $wilayah->total() }} wilayah terdaftar</p>
        </div>
        <a href="{{ route('admin.wilayah.create') }}"
           class="inline-flex items-center justify-center bg-[#143222] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#1b442e] transition shadow-sm w-full sm:w-auto text-center transform hover:-translate-y-0.5 duration-150">
             + Tambah Wilayah
        </a>
    </div>

    {{-- Alert Error / Gagal Hapus --}}
    @if(session('error'))
    <div class="mb-5 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2 shadow-sm animate-fade-in">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    {{-- Filter Search Section --}}
    <div class="bg-white p-4 rounded-2xl border border-stone-200 mb-5 shadow-sm">
        <form action="{{ route('admin.wilayah.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari berdasarkan nama wilayah..." 
                       class="w-full pl-10 pr-4 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 font-medium transition-all shadow-sm">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 sm:flex-none bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-800 transition shadow-sm cursor-pointer">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.wilayah.index') }}" class="flex-1 sm:flex-none bg-stone-100 text-stone-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-stone-200 transition border border-stone-300 flex items-center justify-center shadow-sm">
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
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600">Nama Wilayah</th>
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600 w-44">Jumlah Jemaat</th>
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600 w-44">Dibuat</th>
                    <th class="text-center px-5 py-3.5 font-bold text-stone-600 w-40">Aksi</th>
                </tr>
            </thead>
            
            <tbody class="block md:table-row-group space-y-3 md:space-y-0 divide-y divide-none md:divide-stone-100">
                @forelse($wilayah as $i => $wilayahItem)
                <tr class="block md:table-row bg-white md:bg-transparent border border-stone-200 md:border-none rounded-2xl p-4 shadow-sm md:shadow-none hover:bg-stone-50/50 transition-colors duration-150">
                    
                    <td class="hidden md:table-cell px-5 py-4 text-center text-stone-400 font-medium">
                        {{ $wilayah->firstItem() + $i }}
                    </td>
                    
                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none pb-2 font-bold text-stone-800">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Nama Wilayah</span>
                        <span class="text-right md:text-left">{{ $wilayahItem->nama_wilayah }}</span>
                    </td>
                    
                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Jumlah Jemaat</span>
                        <div>
                            <span class="bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded-full text-xs font-bold border border-blue-100 shadow-sm inline-block">
                                {{ $wilayahItem->jemaat_count ?? 0 }} jemaat
                            </span>
                        </div>
                    </td>
                    
                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2 text-stone-400 text-xs font-medium">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Dibuat Pada</span>
                        <span class="text-right md:text-left">{{ $wilayahItem->created_at->format('d M Y') }}</span>
                    </td>
                    
                    <td class="flex justify-end md:table-cell px-0 md:px-5 pt-3 md:py-3 text-center">
                        <div class="flex items-center justify-end md:justify-center gap-2 w-full sm:w-auto">
                            <a href="{{ route('admin.wilayah.edit', $wilayahItem) }}"
                               class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200 rounded-xl text-xs font-bold transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            
                            <form action="{{ route('admin.wilayah.destroy', $wilayahItem) }}"
                                  method="POST"
                                  class="flex-1 sm:flex-none inline-block m-0"
                                  onsubmit="return confirm('Hapus wilayah \'{{ $wilayahItem->nama_wilayah }}\'? PERINGATAN: Semua Jadwal PA dan Warta Mimbar di wilayah ini akan ikut terhapus otomatis!')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 rounded-xl text-xs font-bold transition-all shadow-sm cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="block md:table-row bg-white border border-stone-200 md:border-none rounded-2xl p-8 text-center">
                    <td colspan="5" class="block md:table-cell py-12 text-stone-400">
                        <div class="max-w-sm mx-auto flex flex-col items-center">
                            <div class="w-14 h-14 bg-stone-100 rounded-full flex items-center justify-center text-xl mb-3 shadow-inner">🔍</div>
                            <h3 class="text-stone-700 font-bold text-base mb-0.5">Data Tidak Ditemukan</h3>
                            <p class="text-xs text-stone-400 px-4 mb-3">Tidak ditemukan catatan wilayah yang sesuai.</p>
                            @if(request('search'))
                                <a href="{{ route('admin.wilayah.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 border border-emerald-100 rounded-xl shadow-sm">
                                    Kembali lihat semua wilayah →
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
        Menampilkan data pembagian wilayah jemaat
    </span>
    <div class="shadow-sm rounded-xl overflow-hidden bg-white order-1 sm:order-2">
        {{ $wilayah->appends(request()->query())->links() }}
    </div>
</div>

@endsection