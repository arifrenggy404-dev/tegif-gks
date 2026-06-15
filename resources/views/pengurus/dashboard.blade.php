@extends('layouts.pengurus')
@section('title', 'Dashboard Pengurus')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold text-stone-800">Dashboard Pengurus</h2>
    <p class="text-stone-500 text-sm">Ringkasan informasi pelayanan gereja</p>
</div>

{{-- ═══════════ KARTU STATISTIK ═══════════ --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm">
        <p class="text-xs font-bold text-stone-400 uppercase mb-1">Total Jemaat</p>
        <p class="text-2xl font-extrabold text-emerald-700">{{ $totalJemaat }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm">
        <p class="text-xs font-bold text-stone-400 uppercase mb-1">Pelayan Aktif</p>
        <p class="text-2xl font-extrabold text-emerald-700">{{ $pelayanAktif }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm">
        <p class="text-xs font-bold text-stone-400 uppercase mb-1">Wilayah</p>
        <p class="text-2xl font-extrabold text-emerald-700">{{ $totalWilayah }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm">
        <p class="text-xs font-bold text-stone-400 uppercase mb-1">Total Asset</p>
        <p class="text-2xl font-extrabold text-emerald-700">{{ $totalAsset }}</p>
    </div>
</div>

{{-- ═══════════ JADWAL IBADAH TERDEKAT ═══════════ --}}
<div class="bg-white rounded-2xl border border-stone-200 shadow-sm mb-6 overflow-hidden">
    <div class="px-5 py-4 border-b border-stone-100 flex items-center justify-between">
        <h3 class="font-bold text-stone-800">Jadwal Ibadah Minggu Terdekat</h3>
        <a href="{{ route('pengurus.jadwal-ibadah.index') }}" class="text-xs font-bold text-emerald-700 hover:underline">Lihat semua →</a>
    </div>
    <div class="divide-y divide-stone-100">
        @forelse($ibadahMendatang as $ibadah)
        <div class="px-5 py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <p class="font-semibold text-stone-800 text-sm">{{ $ibadah->waktu->format('l, d M Y - H:i') }} WITA</p>
                <p class="text-xs text-stone-500">
                    {{ $ibadah->lokasi }}
                    @if($ibadah->tema) · {{ $ibadah->tema }} @endif
                </p>
            </div>
            <div class="text-xs text-stone-600">
                <span class="font-semibold">Pelayan:</span> {{ $ibadah->pelayan->nama_pelayan ?? '-' }} ·
                <span class="font-semibold">Pendamping:</span> {{ $ibadah->pendamping->nama_pelayan ?? '-' }}
            </div>
        </div>
        @empty
        <div class="px-5 py-6 text-center text-sm text-stone-400">Belum ada jadwal ibadah mendatang.</div>
        @endforelse
    </div>
</div>

{{-- ═══════════ JADWAL PA & KESASI MENDATANG ═══════════ --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

    {{-- Jadwal PA --}}
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-stone-100 flex items-center justify-between">
            <h3 class="font-bold text-stone-800">Jadwal PA Mendatang</h3>
            <a href="{{ route('pengurus.jadwal-pa.index') }}" class="text-xs font-bold text-emerald-700 hover:underline">Lihat semua →</a>
        </div>
        <div class="divide-y divide-stone-100">
            @forelse($paMendatang as $pa)
            <div class="px-5 py-3">
                <p class="font-semibold text-stone-800 text-sm">{{ $pa->waktu->format('d M Y - H:i') }}</p>
                <p class="text-xs text-stone-500">{{ $pa->wilayah->nama_wilayah ?? '-' }} · {{ $pa->nama_penerima_pa }}</p>
            </div>
            @empty
            <div class="px-5 py-6 text-center text-sm text-stone-400">Belum ada jadwal PA mendatang.</div>
            @endforelse
        </div>
    </div>

    {{-- Jadwal Kesasi --}}
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-stone-100 flex items-center justify-between">
            <h3 class="font-bold text-stone-800">Jadwal Kesasi Mendatang</h3>
            <a href="{{ route('pengurus.jadwal-kesasi.index') }}" class="text-xs font-bold text-emerald-700 hover:underline">Lihat semua →</a>
        </div>
        <div class="divide-y divide-stone-100">
            @forelse($kesasiMendatang as $kesasi)
            <div class="px-5 py-3">
                <p class="font-semibold text-stone-800 text-sm">{{ $kesasi->waktu->format('d M Y - H:i') }}</p>
                <p class="text-xs text-stone-500">Pengajar: {{ $kesasi->pengajar->nama_pelayan ?? '-' }}</p>
            </div>
            @empty
            <div class="px-5 py-6 text-center text-sm text-stone-400">Belum ada jadwal kesasi mendatang.</div>
            @endforelse
        </div>
    </div>
</div>
{{-- ═══════════ WARTA MIMBAR TERBARU ═══════════ --}}
<div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-stone-100 flex items-center justify-between">
        <h3 class="font-bold text-stone-800">Warta Mimbar Terbaru</h3>
        <a href="{{ route('pengurus.wartamimbar.index') }}" class="text-xs font-bold text-emerald-700 hover:underline">Lihat semua →</a>
    </div>
    <div class="divide-y divide-stone-100">
        @forelse($wartaTerbaru as $warta)
        <div class="px-5 py-3 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-stone-800">
                    @if($warta->ibadah)
                        Ibadah Minggu — {{ $warta->ibadah->tema ?? $warta->ibadah->ayat_bacaan }}
                    @elseif($warta->pelayananPa)
                        PA — {{ $warta->pelayananPa->nama_penerima_pa }}
                    @else
                        Warta Mimbar
                    @endif
                </p>
                <p class="text-xs text-stone-400">oleh {{ $warta->user->nama ?? '-' }}</p>
            </div>
            <p class="text-xs text-stone-400">{{ $warta->tanggal->format('d M Y') }}</p>
        </div>
        @empty
        <div class="px-5 py-6 text-center text-sm text-stone-400">Belum ada warta mimbar.</div>
        @endforelse
    </div>
</div>
@endsection
