@extends('layouts.admin')
@section('title','Warta Mimbar')
@section('content')

<div class="max-w-full overflow-x-hidden px-1 py-2">
    {{-- Header Section (Responsive Stack) --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-stone-800">Warta Mimbar</h2>
            <p class="text-stone-500 text-sm">Total {{ $warta->total() }} catatan warta mimbar</p>
        </div>
        <a href="{{ route('admin.wartamimbar.create') }}" 
           class="inline-flex items-center justify-center bg-[#143222] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#1b442e] transition shadow-md w-full sm:w-auto text-center transform hover:-translate-y-0.5 duration-150">
             + Tambah Warta
        </a>
    </div>

    {{-- Alert Sukses (Opsional jika ditambahkan nanti) --}}
    @if(session('success'))
    <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2 shadow-sm animate-fade-in">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
    <div class="mb-4 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2 shadow-sm animate-fade-in">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    {{-- Table / Cards Container --}}
    <div class="bg-transparent md:bg-white rounded-2xl md:border md:border-stone-200 overflow-hidden shadow-sm w-full">
        <table class="w-full text-sm block md:table">
            <thead class="bg-stone-50 border-b border-stone-200 hidden md:table-header-group">
                <tr>
                    <th class="text-center px-5 py-3.5 font-bold text-stone-600 w-14">#</th>
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600 w-44">Tanggal</th>
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600">Informasi Warta</th>
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600 w-52">Dibuat Oleh</th>
                    <th class="text-center px-5 py-3.5 font-bold text-stone-600 w-40">Aksi</th>
                </tr>
            </thead>
            
            <tbody class="block md:table-row-group space-y-3 md:space-y-0 divide-y divide-none md:divide-stone-100">
                @forelse($warta as $i => $wartaMimbar)
                <tr class="block md:table-row bg-white md:bg-transparent border border-stone-200 md:border-none rounded-2xl p-4 shadow-sm md:shadow-none hover:bg-stone-50/50 transition-colors duration-150">
                    
                    <td class="hidden md:table-cell px-5 py-4 text-center text-stone-400 font-medium">
                        {{ $warta->firstItem() + $i }}
                    </td>
                    
                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none pb-2">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Tanggal</span>
                        <span class="font-bold text-emerald-900 text-right md:text-left">
                            {{ $wartaMimbar->tanggal->format('d M Y') }}
                        </span>
                    </td>
                    
                    <td class="flex flex-col md:table-cell px-0 md:px-5 py-2 md:py-4 border-b border-stone-50 md:border-none text-stone-600 max-w-xs md:max-w-md break-words">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden mb-0.5">Informasi Warta</span>
                        <span class="text-left leading-relaxed text-stone-600">
                            {{ Str::limit($wartaMimbar->informasi, 80) }}
                        </span>
                    </td>
                    
                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2 text-stone-500 font-medium">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Dibuat Oleh</span>
                        <span class="text-right md:text-left bg-stone-100 md:bg-transparent px-2 py-0.5 md:p-0 rounded text-xs md:text-sm text-stone-700 md:text-stone-500 font-semibold md:font-medium">
                            {{ $wartaMimbar->user->nama ?? 'Admin' }}
                        </span>
                    </td>
                    
                    <td class="flex justify-end md:table-cell px-0 md:px-5 pt-3 md:py-3 text-center">
                        <div class="flex items-center justify-end md:justify-center gap-2 w-full sm:w-auto">
                            <a href="{{ route('admin.wartamimbar.edit', $wartaMimbar) }}" 
                               class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200 rounded-xl text-xs font-bold transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            
                            <form action="{{ route('admin.wartamimbar.destroy', $wartaMimbar) }}" 
                                  method="POST" 
                                  class="flex-1 sm:flex-none inline-block m-0"
                                  onsubmit="return confirm('Hapus warta ini?')">
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
                            <div class="w-14 h-14 bg-stone-100 rounded-full flex items-center justify-center text-2xl mb-3 shadow-inner">📢</div>
                            <h3 class="text-stone-700 font-bold text-base mb-0.5">Warta Masih Kosong</h3>
                            <p class="text-xs text-stone-400 px-4 mb-0">Belum ada catatan pengumuman atau warta mimbar terbaru yang diunggah.</p>
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
        Menampilkan data ringkasan lembar informasi jemaat mingguan
    </span>
    <div class="shadow-sm rounded-xl overflow-hidden bg-white order-1 sm:order-2">
        {{ $warta->appends(request()->query())->links() }}
    </div>
</div>

@endsection