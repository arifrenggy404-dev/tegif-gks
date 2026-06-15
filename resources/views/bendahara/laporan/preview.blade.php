@extends('layouts.bendahara')
@section('title', 'Preview — ' . $bulanLabel . ' ' . $tahun)
@section('content')

{{-- Page Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <a href="{{ route('bendahara.laporan.index') }}"
           class="inline-flex items-center gap-1.5 text-stone-500 hover:text-emerald-600 text-xs font-semibold transition-colors mb-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali ke Laporan
        </a>
        <h1 class="text-xl font-bold text-stone-800 mb-0.5">Preview Laporan</h1>
        <p class="text-stone-500 text-xs font-medium">{{ $bulanLabel }} {{ $tahun }}</p>
    </div>
    
    <div class="flex items-center gap-2.5">
        <a href="{{ route('bendahara.laporan.stream') }}?bulan={{ $periode }}"
           target="_blank"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-xl text-xs font-semibold hover:bg-blue-100 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
            </svg>
            Buka PDF
        </a>
        <a href="{{ route('bendahara.laporan.download') }}?bulan={{ $periode }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl text-xs font-semibold hover:from-emerald-700 hover:to-emerald-600 transition shadow-md shadow-emerald-600/15">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
            </svg>
            Download PDF
        </a>
    </div>
</div>

{{-- Stat Summary Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    {{-- Saldo Awal --}}
    <div class="bg-white border border-stone-200 rounded-xl p-4 shadow-sm">
        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Saldo Awal</p>
        <p class="text-base font-bold text-stone-800">Rp {{ number_format($saldoAwal,0,',','.') }}</p>
    </div>
    
    {{-- Total Pemasukan --}}
    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 shadow-sm">
        <p class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider mb-1">Total Pemasukan</p>
        <p class="text-base font-bold text-emerald-700">+Rp {{ number_format($totalPemasukan,0,',','.') }}</p>
    </div>
    
    {{-- Total Pengeluaran --}}
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 shadow-sm">
        <p class="text-[10px] font-bold text-red-700 uppercase tracking-wider mb-1">Total Pengeluaran</p>
        <p class="text-base font-bold text-red-700">-Rp {{ number_format($totalPengeluaran,0,',','.') }}</p>
    </div>
    
    {{-- Saldo Akhir --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 shadow-sm">
        <p class="text-[10px] font-bold text-blue-700 uppercase tracking-wider mb-1">Saldo Akhir</p>
        <p class="text-base font-bold {{ $saldoAkhir >= 0 ? 'text-blue-700' : 'text-red-600' }}">
            Rp {{ number_format($saldoAkhir,0,',','.') }}
        </p>
    </div>
</div>

{{-- Preview Paper --}}
<div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden mb-6">

    {{-- Kop Dokumen --}}
    <div class="bg-gradient-to-br from-slate-900 to-blue-950 p-6 md:p-8 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center text-xl font-bold border border-white/15 shrink-0">✝</div>
                <div>
                    <h2 class="text-base font-bold tracking-wide">TEGIF — GKS Kanatang</h2>
                    <p class="text-slate-400 text-xs mt-0.5">Gereja Kristen Sumba</p>
                </div>
            </div>
            <div class="sm:text-end text-start">
                <span class="inline-block text-[11px] font-bold bg-white/15 px-4 py-1 rounded-full border border-white/20 tracking-wider">
                    LAPORAN KEUANGAN
                </span>
                <p class="text-slate-400 text-xs mt-2.5 font-medium">{{ $bulanLabel }} {{ $tahun }}</p>
            </div>
        </div>
    </div>

    {{-- Tabel Rincian Transaksi --}}
    <div class="p-6">
        <h3 class="text-xs font-bold text-stone-400 uppercase tracking-widest mb-4">
            Rincian Transaksi — {{ $bulanLabel }} {{ $tahun }}
        </h3>

        <div class="overflow-x-auto border border-stone-200 rounded-xl">
            <table class="w-full text-left border-collapse text-xs md:text-sm">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200 text-stone-500 font-bold text-[11px] uppercase tracking-wider">
                        <th class="py-3 px-4 w-12 text-center">#</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Keterangan</th>
                        <th class="py-3 px-4">Jenis</th>
                        <th class="py-3 px-4 text-right">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-stone-700">
                    @php $no = 1; @endphp
                    @forelse($transaksi as $t)
                        <tr class="hover:bg-stone-50/50 transition-colors {{ $loop->even ? 'bg-stone-50/30' : '' }}">
                            <td class="py-3 px-4 text-center text-stone-400 font-medium">{{ $no++ }}</td>
                            <td class="py-3 px-4 font-semibold text-stone-900 whitespace-nowrap">{{ $t->tanggal_transaksi->format('d M Y') }}</td>
                            <td class="py-3 px-4 max-w-xs md:max-w-sm break-words">{{ $t->keterangan ?? '-' }}</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                @if($t->jenis_transaksi === 'pemasukan')
                                    <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-800 px-2.5 py-0.5 rounded-full text-[10px] font-bold">
                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5-7.5M12 3v18"/>
                                        </svg>
                                        Pemasukan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-[10px] font-bold">
                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3"/>
                                        </svg>
                                        Pengeluaran
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-right font-bold whitespace-nowrap text-xs md:text-sm {{ $t->jenis_transaksi === 'pemasukan' ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $t->jenis_transaksi === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($t->total,0,',','.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-stone-400">
                                <svg class="w-10 h-10 text-stone-200 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z"/>
                                </svg>
                                Tidak ada transaksi pada periode ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-emerald-50/60 font-bold text-emerald-800">
                        <td colspan="4" class="py-3 px-4 border-t border-emerald-100">Total Pemasukan</td>
                        <td class="py-3 px-4 text-right border-t border-emerald-100 text-xs md:text-sm">Rp {{ number_format($totalPemasukan,0,',','.') }}</td>
                    </tr>
                    <tr class="bg-red-50/60 font-bold text-red-800">
                        <td colspan="4" class="py-3 px-4 border-t border-red-100">Total Pengeluaran</td>
                        <td class="py-3 px-4 text-right border-t border-red-100 text-xs md:text-sm">Rp {{ number_format($totalPengeluaran,0,',','.') }}</td>
                    </tr>
                    <tr class="bg-blue-50 font-bold text-blue-900 text-xs md:text-sm">
                        <td colspan="4" class="py-3.5 px-4 border-t border-blue-200 uppercase tracking-wider">SALDO AKHIR</td>
                        <td class="py-3.5 px-4 text-right border-t border-blue-200 text-sm md:text-base {{ $saldoAkhir >= 0 ? 'text-blue-700' : 'text-red-600' }}">
                            Rp {{ number_format($saldoAkhir,0,',','.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Footer Tanda Tangan Laporan --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-6 p-6 border-t border-stone-100 bg-stone-50/50">
        <div>
            <p class="text-[11px] text-stone-400 leading-relaxed">
                Dicetak: <span class="font-medium text-stone-600">{{ $dicetak }}</span><br>
                Oleh: <span class="font-medium text-stone-600">{{ $dicetakOleh }}</span>
            </p>
        </div>
        <div class="text-center sm:self-auto self-end min-w-[200px]">
            <p class="text-xs text-stone-500 mb-14">
                Kanatang, {{ now()->isoFormat('D MMMM YYYY') }}
            </p>
            <p class="text-xs font-bold text-stone-800 border-t border-stone-400 pt-2">
                Bendahara Gereja
            </p>
        </div>
    </div>

</div>

@endsection