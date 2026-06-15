@extends('layouts.bendahara')
@section('title', 'Kas & Keuangan')
@section('content')

<div class="max-w-full overflow-x-hidden px-0.5 py-1">
    {{-- Summary Bar (Responsive Grid - Stack di HP, Berjejer di Laptop) --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-5 py-4 shadow-sm">
            <p class="text-[11px] text-emerald-600 font-bold uppercase tracking-wider">Total Pemasukan</p>
            <p class="text-xl font-extrabold text-emerald-700 mt-1 break-all">
                Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
            </p>
        </div>
        <div class="bg-rose-50 border border-rose-200 rounded-2xl px-5 py-4 shadow-sm">
            <p class="text-[11px] text-rose-600 font-bold uppercase tracking-wider">Total Pengeluaran</p>
            <p class="text-xl font-extrabold text-rose-600 mt-1 break-all">
                Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
            </p>
        </div>
        <div class="bg-stone-50 border border-stone-200 rounded-2xl px-5 py-4 shadow-sm">
            <p class="text-[11px] text-stone-500 font-bold uppercase tracking-wider">Saldo</p>
            <p class="text-xl font-extrabold {{ $saldo >= 0 ? 'text-stone-800' : 'text-rose-600' }} mt-1 break-all">
                Rp {{ number_format($saldo, 0, ',', '.') }}
            </p>
        </div>
    </div>

    {{-- Filter & Tambah (Auto Wrap & Stacking agar tidak keluar batas) --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6 gap-4">
        <form method="GET" action="{{ route('bendahara.keuangan.index') }}"
              class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 w-full lg:w-auto">
            <select name="jenis" onchange="this.form.submit()"
                class="bg-white border border-stone-200 rounded-xl px-3 py-2.5 text-sm font-semibold text-stone-700 focus:outline-none focus:border-[#143222] focus:ring-4 focus:ring-emerald-50/50 transition-all w-full sm:w-40 shadow-sm cursor-pointer">
                <option value="">Semua Jenis</option>
                <option value="pemasukan"   {{ request('jenis')=='pemasukan'   ? 'selected':'' }}>Pemasukan</option>
                <option value="pengeluaran" {{ request('jenis')=='pengeluaran' ? 'selected':'' }}>Pengeluaran</option>
            </select>

            <input type="month" name="bulan" value="{{ request('bulan') }}"
                   onchange="this.form.submit()"
                   class="bg-white border border-stone-200 rounded-xl px-3 py-2.5 text-sm font-semibold text-stone-700 focus:outline-none focus:border-[#143222] focus:ring-4 focus:ring-emerald-50/50 transition-all w-full sm:w-44 shadow-sm cursor-pointer">

            @if(request()->hasAny(['jenis','bulan']))
            <a href="{{ route('bendahara.keuangan.index') }}"
               class="text-xs font-bold text-stone-400 hover:text-rose-600 transition-colors py-2 text-center sm:text-left">✕ Reset Filter</a>
            @endif
        </form>

        <a href="{{ route('bendahara.keuangan.create') }}"
           class="inline-flex items-center justify-center gap-1.5 bg-[#143222] hover:bg-[#1b442e] text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all w-full lg:w-auto text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Transaksi
        </a>
    </div>

    {{-- Data List / Table Container --}}
    <div class="bg-transparent md:bg-white rounded-2xl md:border md:border-stone-200 md:shadow-sm overflow-hidden w-full">
        <table class="w-full text-sm block md:table">
            <thead class="bg-stone-50 border-b border-stone-200 hidden md:table-header-group">
                <tr>
                    <th class="px-5 py-3.5 text-xs font-bold text-stone-500 uppercase tracking-wide text-center w-12">#</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-stone-500 uppercase tracking-wide w-32">Tanggal</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-stone-500 uppercase tracking-wide w-32">Jenis</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-stone-500 uppercase tracking-wide">Keterangan</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-stone-500 uppercase tracking-wide text-right w-40">Jumlah</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-stone-500 uppercase tracking-wide w-36">Dicatat</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-stone-500 uppercase tracking-wide text-center w-40">Aksi</th>
                </tr>
            </thead>

            <tbody class="block md:table-row-group space-y-3 md:space-y-0 divide-y divide-none md:divide-stone-100">
                @forelse($transaksi as $i => $t)
                <tr class="block md:table-row bg-white md:bg-transparent border border-stone-200 md:border-none rounded-2xl p-4 shadow-sm md:shadow-none transition-colors duration-150 hover:bg-stone-50/40">

                    <td class="hidden md:table-cell px-5 py-4 text-center text-stone-400 font-medium">
                        {{ $transaksi->firstItem() + $i }}
                    </td>

                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none font-semibold text-stone-700">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Tanggal</span>
                        <span class="text-right md:text-left text-xs sm:text-sm">{{ $t->tanggal_transaksi->format('d M Y') }}</span>
                    </td>

                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Jenis</span>
                        <div>
                            @if($t->jenis_transaksi === 'pemasukan')
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm inline-block">
                                ↑ Pemasukan
                            </span>
                            @else
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-100 shadow-sm inline-block">
                                ↓ Pengeluaran
                            </span>
                            @endif
                        </div>
                    </td>

                    <td class="flex flex-col md:table-cell px-0 md:px-5 py-2 md:py-4 border-b border-stone-50 md:border-none text-stone-600 font-medium">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden mb-0.5">Keterangan</span>
                        <span class="block text-stone-700 md:text-stone-600 md:max-w-xs md:truncate break-words text-xs sm:text-sm">{{ $t->keterangan ?? '-' }}</span>
                    </td>

                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none font-black tracking-tight text-xs sm:text-sm">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Jumlah</span>
                        <span class="{{ $t->jenis_transaksi === 'pemasukan' ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $t->jenis_transaksi === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($t->total, 0, ',', '.') }}
                        </span>
                    </td>

                    <td class="flex justify-between items-center md:table-cell px-0 md:px-5 py-1.5 md:py-4 border-b border-stone-50 md:border-none">
                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider md:hidden">Dicatat</span>
                        <span class="text-stone-700 font-bold text-xs">{{ $t->user->nama }}</span>
                    </td>

                    <td class="flex justify-end md:table-cell px-0 md:px-5 pt-3 md:pt-3 pb-0 text-center">
                        <div class="flex items-center justify-end md:justify-center gap-2 w-full">
                            <a href="{{ route('bendahara.keuangan.edit', $t) }}"
                               class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 rounded-xl text-xs font-bold transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('bendahara.keuangan.destroy', $t) }}"
                                  method="POST"
                                  class="flex-1 sm:flex-none inline-block m-0"
                                  class="btn-hapus-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="btn-hapus w-full inline-flex items-center justify-center gap-1 px-3 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 rounded-xl text-xs font-bold transition-all shadow-sm cursor-pointer">
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
                    <td colspan="7" class="block md:table-cell py-12 text-stone-400">
                        <div class="max-w-sm mx-auto flex flex-col items-center">
                            <div class="w-14 h-14 bg-stone-100 rounded-full flex items-center justify-center text-2xl mb-3 shadow-inner">💰</div>
                            <h3 class="text-stone-700 font-bold text-base mb-0.5">Belum Ada Transaksi</h3>
                            <p class="text-xs text-stone-400 px-4 mb-3">Tidak ditemukan catatan kas pada periode ini.</p>
                            <a href="{{ route('bendahara.keuangan.create') }}"
                               class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 border border-emerald-100 rounded-xl shadow-sm">
                                Tambah transaksi pertama ➔
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination Footer (Dioptimalkan agar tidak overflow di HP) --}}
<div class="mt-5 flex flex-col sm:flex-row items-center justify-between gap-4 px-1">
    <span class="text-xs text-stone-400 font-medium order-2 sm:order-1 text-center sm:text-left">
        Menampilkan data laporan kas jemaat
    </span>
    <div class="w-full sm:w-auto max-w-full overflow-x-auto text-xs order-1 sm:order-2 flex justify-center">
        <div class="shadow-sm rounded-xl bg-white p-1">
            {{ $transaksi->links() }}
        </div>
    </div>
</div>

@endsection
