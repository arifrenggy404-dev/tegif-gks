@extends('layouts.admin')
@section('title', 'Detail Jadwal Ibadah')

@section('content')

{{-- Custom CSS Khusus Detail --}}
<style>
    .form-card-shadow { box-shadow: 0 10px 40px -10px rgba(20, 50, 34, 0.08); }
    .section-title {
        font-size: 0.75rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #047857;
        margin-bottom: 1rem;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 0.5rem;
    }
    .info-box {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 0.875rem 1rem;
    }
    .info-label {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94a3b8;
        margin-bottom: 0.25rem;
    }
    .info-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: #1e293b;
        white-space: pre-line;
        line-height: 1.6;
    }
    .info-value.empty {
        color: #cbd5e1;
        font-weight: 500;
        font-style: italic;
    }
</style>

<div class="max-w-3xl mx-auto pb-10">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('admin.jadwal-ibadah.index') }}"
               class="group inline-flex items-center gap-2.5 px-4 py-2 mb-4 bg-white border border-slate-200 rounded-full shadow-sm hover:shadow-md hover:border-emerald-300 transition-all duration-300 w-fit cursor-pointer">
                <div class="bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-600 p-1.5 rounded-full transition-colors duration-300">
                    <svg class="w-3.5 h-3.5 transform transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-700 tracking-wide pr-1">Kembali</span>
            </a>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Detail Jadwal Ibadah</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Informasi lengkap rencana pelayanan ibadah minggu.</p>
        </div>

        <div class="flex items-center gap-2 w-full md:w-auto">
            <a href="{{ route('admin.jadwal-ibadah.edit', $jadwalIbadah) }}"
               class="flex-1 md:flex-none inline-flex items-center justify-center gap-1.5 px-5 py-2.5 bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200 rounded-xl text-xs font-bold transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </a>

            <form action="{{ route('admin.jadwal-ibadah.destroy', $jadwalIbadah) }}"
                  method="POST"
                  class="flex-1 md:flex-none inline-block m-0"
                  onsubmit="return confirm('Hapus jadwal ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-1.5 px-5 py-2.5 bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 rounded-xl text-xs font-bold transition-all shadow-sm cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden form-card-shadow relative">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>

        <div class="p-6 md:p-10 space-y-8">

            {{-- 1. Waktu & Lokasi --}}
            <div>
                <h3 class="section-title">Waktu &amp; Lokasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="info-box">
                        <div class="info-label">Waktu Ibadah</div>
                        <div class="info-value">
                            {{ $jadwalIbadah->waktu->format('l, d F Y') }}
                            <span class="block text-emerald-700">{{ $jadwalIbadah->waktu->format('H:i') }} WITA</span>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">Lokasi Ibadah</div>
                        <div class="info-value">
                            <span class="bg-stone-100 text-stone-700 px-2.5 py-1 rounded-full text-xs font-bold border border-stone-200 shadow-sm inline-block">
                                {{ $jadwalIbadah->lokasi }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Pelayanan --}}
            <div>
                <h3 class="section-title">Pelayanan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="info-box">
                        <div class="info-label">Pelayan</div>
                        <div class="info-value">{{ $jadwalIbadah->pelayan->nama_pelayan }}</div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">Pendamping</div>
                        <div class="info-value">{{ $jadwalIbadah->pendamping->nama_pelayan }}</div>
                    </div>
                </div>
            </div>

            {{-- 3. Tema & Bacaan --}}
            <div>
                <h3 class="section-title">Tema &amp; Bacaan</h3>
                <div class="space-y-5">
                    <div class="info-box">
                        <div class="info-label">Tema Ibadah</div>
                        <div class="info-value {{ $jadwalIbadah->tema ? '' : 'empty' }}">
                            {{ $jadwalIbadah->tema ?: 'Tidak ada tema khusus' }}
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">Ayat Bacaan</div>
                        <div class="info-value">{{ $jadwalIbadah->ayat_bacaan }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="info-box">
                            <div class="info-label">Nats Pembimbing</div>
                            <div class="info-value {{ $jadwalIbadah->nats_pembimbing ? '' : 'empty' }}">
                                {{ $jadwalIbadah->nats_pembimbing ?: '-' }}
                            </div>
                        </div>
                        <div class="info-box">
                            <div class="info-label">Ayat Firman</div>
                            <div class="info-value {{ $jadwalIbadah->ayat_firman ? '' : 'empty' }}">
                                {{ $jadwalIbadah->ayat_firman ?: '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Unsur Liturgi --}}
            <div>
                <h3 class="section-title">Unsur Liturgi</h3>
                <div class="space-y-5">
                    <div class="info-box">
                        <div class="info-label">Berita Anugerah</div>
                        <div class="info-value {{ $jadwalIbadah->berita_anugerah ? '' : 'empty' }}">
                            {{ $jadwalIbadah->berita_anugerah ?: 'Belum diisi' }}
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">Petunjuk Hidup Baru</div>
                        <div class="info-value {{ $jadwalIbadah->petunjuk_hidup_baru ? '' : 'empty' }}">
                            {{ $jadwalIbadah->petunjuk_hidup_baru ?: 'Belum diisi' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- 5. Informasi Tambahan --}}
            <div>
                <h3 class="section-title">Informasi Tambahan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="info-box">
                        <div class="info-label">Dibuat Pada</div>
                        <div class="info-value">{{ $jadwalIbadah->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">Terakhir Diperbarui</div>
                        <div class="info-value">{{ $jadwalIbadah->updated_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3">
                <a href="{{ route('admin.jadwal-ibadah.edit', $jadwalIbadah) }}"
                    class="w-full sm:w-auto bg-[#143222] text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide
                           hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300
                           shadow-lg shadow-emerald-900/20 hover:-translate-y-0.5 flex items-center justify-center gap-2 text-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    Edit Jadwal
                </a>
                <a href="{{ route('admin.jadwal-ibadah.index') }}"
                   class="w-full sm:w-auto bg-white border border-slate-300 text-slate-600 px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide
                          hover:bg-slate-50 hover:border-slate-400 hover:text-slate-800 transition-all duration-300 text-center">
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#143222',
                timer: 2500,
                timerProgressBar: true
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        @endif
    });
</script>

@endsection
