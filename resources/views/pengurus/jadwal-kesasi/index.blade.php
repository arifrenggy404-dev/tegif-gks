@extends('layouts.pengurus')
@section('title','Jadwal Kesasi')
@section('content')

<div class="max-w-full overflow-x-hidden px-1 py-2">
    {{-- Header Section (Responsive Stack) --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-stone-800">Jadwal Katekisasi (Kesasi)</h2>
            <p class="text-stone-500 text-sm">Total {{ $jadwal->total() }} jadwal katekisasi aktif</p>
        </div>
    </div>

    {{-- Alert Sukses --}}
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
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600 w-44">Waktu</th>
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600">Pengajar</th>
                    <th class="text-left px-5 py-3.5 font-bold text-stone-600">Materi Kelas</th>
                </tr>
            </thead>

            <tbody class="block md:table-row-group space-y-3 md:space-y-0 divide-y divide-none md:divide-stone-100">
                @forelse($jadwal as $i => $jadwalKesasi)
                <tr class="block md:table-row bg-white md:bg-transparent border border-stone-200 md:border-none rounded-2xl p-4 shadow-sm md:shadow-none hover:bg-stone-50/50 transition-colors duration-150">

                    <td class="hidden md:table-cell px-5 py-4 text-center text-stone-400 font-medium">
                        {{ $jadwal->firstItem() + $i }}
                    </td>

                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none pb-2">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Waktu</span>
                        <div class="text-right md:text-left">
                            <span class="font-semibold text-stone-800">{{ $jadwalKesasi->waktu->format('d M Y') }}</span>
                            <span class="block text-xs font-bold text-emerald-700 md:text-stone-500 md:mt-0.5">{{ $jadwalKesasi->waktu->format('H:i') }} WITA</span>
                        </div>
                    </td>

                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2 font-semibold text-stone-800">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Pengajar</span>
                        <span class="text-right md:text-left">{{ $jadwalKesasi->pengajar->nama_pelayan }}</span>
                    </td>

                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none py-2 text-stone-600 italic max-w-xs break-words">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden text-left mr-4">Materi</span>
                        <span class="text-right md:text-left">{{ $jadwalKesasi->materi }}</span>
                    </td>
                </tr>
                @empty
                <tr class="block md:table-row bg-white border border-stone-200 md:border-none rounded-2xl p-8 text-center">
                    <td colspan="5" class="block md:table-cell py-12 text-stone-400">
                        <div class="max-w-sm mx-auto flex flex-col items-center">
                            <div class="w-14 h-14 bg-stone-100 rounded-full flex items-center justify-center text-2xl mb-3 shadow-inner">🎓</div>
                            <h3 class="text-stone-700 font-bold text-base mb-0.5">Jadwal Belum Tersedia</h3>
                            <p class="text-xs text-stone-400 px-4 mb-0">Belum ada agenda pelaksanaan kelas katekisasi (kesasi) yang dicatat.</p>
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
        Menampilkan data berkas kelas persiapan sidi jemaat
    </span>
    <div class="shadow-sm rounded-xl overflow-hidden bg-white order-1 sm:order-2">
        {{ $jadwal->appends(request()->query())->links() }}
    </div>
</div>

@endsection
