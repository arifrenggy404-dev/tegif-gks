@extends('layouts.admin')
@section('title', 'Detail Jemaat')
@section('content')

<div class="max-w-3xl mx-auto pb-10">
    {{-- Header & Navigasi --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <a href="{{ route('admin.jemaat.index') }}"
               class="group inline-flex items-center gap-2 text-sm text-emerald-700 font-bold hover:text-emerald-900 transition-colors">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar Jemaat
            </a>
            <h2 class="text-3xl font-extrabold text-slate-800 mt-2 tracking-tight">{{ $jemaat->nama_jemaat }}</h2>
            <p class="text-slate-500 text-sm mt-1">Detail informasi lengkap data jemaat.</p>
        </div>
        <a href="{{ route('admin.jemaat.edit', $jemaat) }}"
           class="inline-flex items-center justify-center gap-2 bg-[#143222] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#1b442e] transition shadow-sm w-full sm:w-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
            Edit Data
        </a>
    </div>

    @php
        $statusColor = match($jemaat->status_jemaat) {
            'aktif'       => 'bg-green-50 text-green-700 border-green-100',
            'tidak_aktif' => 'bg-stone-50 text-stone-500 border-stone-200',
            'pindah'      => 'bg-amber-50 text-amber-700 border-amber-100',
            'meninggal'   => 'bg-rose-50 text-rose-600 border-rose-100',
            default       => 'bg-stone-50 text-stone-500 border-stone-200',
        };

        $statusDalamJemaatLabel = match($jemaat->status_dalam_jemaat) {
            'sidi'         => 'Sidi',
            'baptis'       => 'Baptis',
            'belum_baptis' => 'Belum Baptis',
            'simpatisan'   => 'Simpatisan',
            default        => '-',
        };

        $pekerjaanLabel = match($jemaat->pekerjaan) {
            'petani'    => 'Petani',
            'nelayan'   => 'Nelayan',
            'tukang'    => 'Tukang',
            'buruh'     => 'Buruh',
            'pns'       => 'PNS',
            'pt'        => 'PT',
            'swasta'    => 'Swasta',
            'tni_polri' => 'TNI/POLRI',
            'pensiun'   => 'Pensiun',
            'lainnya'   => 'Lainnya',
            default     => '-',
        };

        $pendidikanLabel = match($jemaat->pendidikan_terakhir) {
            'SD'  => 'SD',
            'SMP' => 'SMP',
            'SMA' => 'SMA',
            'D3'  => 'AMD/D3',
            'S1'  => 'S1',
            'S2'  => 'S2',
            default => '-',
        };
    @endphp

    <div class="space-y-6">

        {{-- DATA DIRI --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>
            <div class="p-6 md:p-8">
                <p class="text-xs font-extrabold uppercase tracking-wider text-emerald-600 mb-4 pb-2 border-b border-slate-200">Data Diri</p>

                <dl class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Nama Lengkap</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $jemaat->nama_jemaat }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Jenis Kelamin</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $jemaat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Tempat, Tanggal Lahir</dt>
                        <dd class="text-sm font-semibold text-slate-800">
                            {{ $jemaat->tempat_lahir }}, {{ $jemaat->tanggal_lahir?->format('d M Y') }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Wilayah Pelayanan</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $jemaat->wilayah->nama_wilayah }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">No. Handphone</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $jemaat->no_hp ?? '-' }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Alamat Domisili</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $jemaat->alamat }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- BAPTIS, SIDI, NIKAH --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>
            <div class="p-6 md:p-8">
                <p class="text-xs font-extrabold uppercase tracking-wider text-emerald-600 mb-4 pb-2 border-b border-slate-200">Tempat &amp; Tanggal Baptis, Sidi, Nikah</p>

                <dl class="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-6">
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Baptis</dt>
                        <dd class="text-sm font-semibold text-slate-800">
                            @if($jemaat->tempat_baptis || $jemaat->tanggal_baptis)
                                {{ $jemaat->tempat_baptis ?? '-' }}<br>
                                <span class="text-slate-500 text-xs">{{ $jemaat->tanggal_baptis?->format('d M Y') ?? '-' }}</span>
                            @else
                                <span class="text-slate-400">Belum baptis</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Sidi</dt>
                        <dd class="text-sm font-semibold text-slate-800">
                            @if($jemaat->tempat_sidi || $jemaat->tanggal_sidi)
                                {{ $jemaat->tempat_sidi ?? '-' }}<br>
                                <span class="text-slate-500 text-xs">{{ $jemaat->tanggal_sidi?->format('d M Y') ?? '-' }}</span>
                            @else
                                <span class="text-slate-400">Belum sidi</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Nikah</dt>
                        <dd class="text-sm font-semibold text-slate-800">
                            @if($jemaat->tempat_nikah || $jemaat->tanggal_nikah)
                                {{ $jemaat->tempat_nikah ?? '-' }}<br>
                                <span class="text-slate-500 text-xs">{{ $jemaat->tanggal_nikah?->format('d M Y') ?? '-' }}</span>
                            @else
                                <span class="text-slate-400">Belum menikah</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- PEKERJAAN & STATUS DALAM JEMAAT --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>
            <div class="p-6 md:p-8">
                <p class="text-xs font-extrabold uppercase tracking-wider text-emerald-600 mb-4 pb-2 border-b border-slate-200">Pekerjaan &amp; Status Dalam Jemaat</p>

                <dl class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Pekerjaan</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $pekerjaanLabel }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Status Dalam Jemaat</dt>
                        <dd>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border shadow-sm inline-block bg-blue-50 text-blue-700 border-blue-100">
                                {{ $statusDalamJemaatLabel }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Hub. Keluarga</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $jemaat->hubungan_keluarga ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Pendidikan Terakhir</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $pendidikanLabel }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- STATUS JEMAAT --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>
            <div class="p-6 md:p-8">
                <p class="text-xs font-extrabold uppercase tracking-wider text-emerald-600 mb-4 pb-2 border-b border-slate-200">Status Jemaat</p>

                <dl class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Status Jemaat</dt>
                        <dd>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border shadow-sm inline-block {{ $statusColor }}">
                                {{ ucfirst(str_replace('_', ' ', $jemaat->status_jemaat)) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase mb-1">Status Pernikahan</dt>
                        <dd class="text-sm font-semibold text-slate-800">
                            {{ ucfirst(str_replace('_', ' ', $jemaat->status_pernikahan)) }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- KETERANGAN --}}
        @if($jemaat->keterangan)
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>
            <div class="p-6 md:p-8">
                <p class="text-xs font-extrabold uppercase tracking-wider text-emerald-600 mb-4 pb-2 border-b border-slate-200">Keterangan</p>
                <p class="text-sm text-slate-700 whitespace-pre-line">{{ $jemaat->keterangan }}</p>
            </div>
        </div>
        @endif

    </div>

    {{-- Tombol Aksi Bawah --}}
    <div class="mt-6 flex flex-col sm:flex-row items-center gap-3">
        <a href="{{ route('admin.jemaat.index') }}"
           class="w-full sm:w-auto bg-white border border-slate-300 text-slate-600 px-8 py-3.5 rounded-xl text-sm font-bold text-center hover:bg-slate-50 transition-all">
            Kembali ke Daftar
        </a>
        <form action="{{ route('admin.jemaat.destroy', $jemaat) }}" method="POST"
              class="w-full sm:w-auto" onsubmit="return confirm('Hapus data jemaat ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="w-full sm:w-auto bg-rose-50 border border-rose-200 text-rose-700 px-8 py-3.5 rounded-xl text-sm font-bold text-center hover:bg-rose-100 transition-all">
                Hapus Data
            </button>
        </form>
    </div>
</div>

@endsection
