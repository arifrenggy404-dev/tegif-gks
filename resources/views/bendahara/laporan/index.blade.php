@extends('layouts.bendahara')
@section('title', 'Laporan Keuangan')
@section('content')

{{-- Page Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-stone-800 mb-1">Laporan Keuangan</h1>
        <p class="text-stone-500 text-xs">Cetak laporan bulanan dalam format PDF resmi</p>
    </div>
    <a href="{{ route('bendahara.keuangan.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-stone-100 text-stone-600 border border-stone-200 rounded-xl text-xs font-semibold hover:bg-stone-200 transition-colors shadow-sm w-fit">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
        </svg>
        Kembali
    </a>
</div>

{{-- Main Responsive Grid Content --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

    {{-- ══ KARTU CETAK LAPORAN (Sisi Kiri) ══ --}}
    <div class="lg:col-span-5 bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
        {{-- Header kartu --}}
        <div class="bg-gradient-to-br from-emerald-800 to-emerald-600 p-5 text-white">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-white/15 rounded-xl flex items-center justify-center border border-white/20 shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm leading-snug">Cetak Laporan Bulanan</h3>
                    <p class="text-emerald-100 text-xs opacity-80 mt-0.5">Pilih periode untuk dicetak</p>
                </div>
            </div>
        </div>

        {{-- Body Form --}}
        <div class="p-6">
            <form action="{{ route('bendahara.laporan.preview') }}" method="GET" id="formLaporan" class="space-y-4">
                {{-- Input Periode --}}
                <div>
                    <label for="inputBulan" class="block text-xs font-semibold text-stone-700 mb-2">
                        Pilih Periode
                    </label>
                    <div class="flex items-center border border-stone-200 rounded-xl bg-stone-50 overflow-hidden focus-within:border-emerald-600 focus-within:ring-2 focus-within:ring-emerald-600/10 transition-all">
                        <span class="pl-4 pr-2 text-stone-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                        </span>
                        <input type="month" name="bulan" id="inputBulan"
                               value="{{ now()->format('Y-m') }}"
                               class="w-full bg-transparent border-none outline-none py-2.5 px-2 text-sm font-semibold text-stone-900 shadow-none focus:ring-0" 
                               required>
                    </div>
                    <p class="text-stone-400 text-[11px] mt-2 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-stone-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                        Format: Tahun-Bulan (contoh: 2025-06)
                    </p>
                </div>

                {{-- Kumpulan Tombol Aksi --}}
                <div class="flex flex-col gap-2.5 pt-2">
                    {{-- Preview --}}
                    <button type="submit"
                            formaction="{{ route('bendahara.laporan.preview') }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-stone-50 text-stone-700 border border-stone-200 rounded-xl text-xs font-semibold hover:bg-stone-100 transition shadow-sm">
                        <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Preview Laporan
                    </button>

                    {{-- Buka PDF Tab Baru --}}
                    <button type="button"
                            onclick="bukaStream()"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-xl text-xs font-semibold hover:bg-blue-100 transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                        </svg>
                        Buka PDF di Tab Baru
                    </button>

                    {{-- Download PDF --}}
                    <button type="submit"
                            formaction="{{ route('bendahara.laporan.download') }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl text-xs font-semibold hover:from-emerald-700 hover:to-emerald-600 transition shadow-md shadow-emerald-600/15">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                        </svg>
                        Download PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══ DAFTAR PERIODE TERSEDIA (Sisi Kanan) ══ --}}
    <div class="lg:col-span-7 bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
        {{-- Card Header --}}
        <div class="p-5 border-b border-stone-100 bg-white">
            <div class="flex items-center gap-4">
                <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center border border-amber-200 shrink-0">
                    <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-stone-800 leading-snug">Periode Tersedia</h3>
                    <p class="text-stone-400 text-xs mt-0.5">Bulan yang memiliki catatan transaksi</p>
                </div>
            </div>
        </div>

        {{-- Card Body List --}}
        <div class="divide-y divide-stone-100 max-h-[440px] overflow-y-auto">
            @if($periodeList->isEmpty())
                <div class="text-center py-12 text-stone-400">
                    <svg class="w-12 h-12 text-stone-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z"/>
                    </svg>
                    <p class="text-sm font-medium text-stone-600">Belum ada rekam transaksi</p>
                    <p class="text-xs text-stone-400 mt-0.5">Silakan tambahkan data kas terlebih dahulu</p>
                </div>
            @else
                @php
                    $namaBulan = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                                  7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
                @endphp
                @foreach($periodeList as $p)
                    @php
                        $val         = $p->tahun.'-'.str_pad($p->bulan,2,'0',STR_PAD_LEFT);
                        $totalMasuk  = \App\Models\Keuangan::pemasukan()->whereYear('tanggal_transaksi',$p->tahun)->whereMonth('tanggal_transaksi',$p->bulan)->sum('total');
                        $totalKeluar = \App\Models\Keuangan::pengeluaran()->whereYear('tanggal_transaksi',$p->tahun)->whereMonth('tanggal_transaksi',$p->bulan)->sum('total');
                        $saldoBulan  = $totalMasuk - $totalKeluar;
                    @endphp
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 gap-4 hover:bg-stone-50/80 transition-colors">
                        
                        {{-- Sisi Kiri: Detail Data & Tanggal --}}
                        <div class="flex items-center gap-4">
                            {{-- Blok Badge Kalender Bulanan --}}
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-800 to-emerald-600 rounded-xl flex flex-col items-center justify-center shrink-0 shadow-sm">
                                <span class="text-sm font-bold text-white leading-none">{{ str_pad($p->bulan,2,'0',STR_PAD_LEFT) }}</span>
                                <span class="text-[9px] font-semibold text-emerald-200/90 uppercase tracking-wider mt-0.5">{{ substr($namaBulan[$p->bulan],0,3) }}</span>
                            </div>
                            
                            {{-- Label Periode & Ringkasan Angka Nominal --}}
                            <div>
                                <h4 class="text-sm font-bold text-stone-800">{{ $namaBulan[$p->bulan] }} {{ $p->tahun }}</h4>
                                <div class="flex flex-wrap items-center gap-x-2 gap-y-0.5 mt-1 text-[11.5px] font-medium">
                                    <span class="text-emerald-600">+Rp {{ number_format($totalMasuk,0,',','.') }}</span>
                                    <span class="text-stone-300">|</span>
                                    <span class="text-red-600">-Rp {{ number_format($totalKeluar,0,',','.') }}</span>
                                    <span class="text-stone-300">|</span>
                                    <span class="font-bold {{ $saldoBulan >= 0 ? 'text-blue-600' : 'text-red-600' }}">
                                        Rp {{ number_format($saldoBulan,0,',','.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Sisi Kanan: Pasangan Tombol Aksi Akhir --}}
                        <div class="flex items-center gap-2 shrink-0 sm:self-center self-end">
                            <a href="{{ route('bendahara.laporan.stream') }}?bulan={{ $val }}"
                               target="_blank"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg text-xs font-semibold hover:bg-blue-100 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                                PDF
                            </a>
                            <a href="{{ route('bendahara.laporan.download') }}?bulan={{ $val }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-lg text-xs font-semibold hover:from-emerald-700 hover:to-emerald-600 transition-all shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                                Unduh
                            </a>
                        </div>

                    </div>
                @endforeach
            @endif
        </div>
    </div>

</div>

<script>
function bukaStream() {
    const bulan = document.getElementById('inputBulan').value;
    if (!bulan) { alert('Pilih periode terlebih dahulu'); return; }
    window.open('{{ route("bendahara.laporan.stream") }}?bulan=' + bulan, '_blank');
}
</script>

@endsection