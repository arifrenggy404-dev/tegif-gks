@extends('layouts.public')
@section('title', 'Jadwal Katekisasi')
@section('content')

{{-- ═══════════════════════════════════════════════════════════════
     TEMA: Deep Sage / Emerald — GKS Kanatang (Katekisasi/Kesasi)
     Aksen khusus halaman ini: Emerald-Teal untuk kelas pengajaran
     (beda dari halaman ibadah yang pakai sage murni)
═══════════════════════════════════════════════════════════════ --}}

<style>
    :root {
        --sage-950: #0B1C12;
        --sage-900: #122218;
        --sage-800: #1A3324;
        --sage-750: #1F3D2C;
        --sage-700: #214A32;
        --sage-600: #2E6347;
        --sage-500: #3D7E5A;
        --sage-400: #52A076;
        --sage-300: #7DC49B;
        --sage-200: #B0DFCA;
        --sage-150: #CBF0DC;
        --sage-100: #D8F0E5;
        --sage-50:  #EEF8F3;
        --teal-700: #0E5A4F;
        --teal-600: #127A6D;
        --teal-500: #179E8C;
        --teal-300: #5DCDC0;
        --teal-100: #C8F0EC;
        --teal-50:  #EAFAF9;
        --gold-500: #C9A84C;
        --gold-200: #F0D89A;
        --gold-100: #FAF0D7;
    }

    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Source+Sans+3:wght@400;500;600;700&display=swap');

    .church-serif { font-family: 'Cormorant Garamond', 'Georgia', serif; }
    .church-body  { font-family: 'Source Sans 3', 'Segoe UI', sans-serif; }

    .katekisasi-card {
        background: #FFFFFF;
        border: 1px solid var(--sage-100);
        border-left: 4px solid var(--teal-600);
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        box-shadow: 0 1px 6px rgba(14, 90, 79, 0.06), 0 4px 16px rgba(14, 90, 79, 0.04);
        transition: box-shadow 0.2s ease, transform 0.15s ease;
    }
    .katekisasi-card:hover {
        box-shadow: 0 4px 20px rgba(14, 90, 79, 0.12), 0 8px 32px rgba(14, 90, 79, 0.06);
        transform: translateY(-1px);
    }

    .date-badge-teal {
        background: var(--teal-50);
        border: 1.5px solid var(--teal-100);
        border-radius: 10px;
        min-width: 68px;
        text-align: center;
        padding: 0.6rem 0.75rem;
        flex-shrink: 0;
    }
    .date-badge-teal .day-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
        color: var(--teal-700);
        display: block;
    }
    .date-badge-teal .month-str {
        font-family: 'Source Sans 3', sans-serif;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--teal-500);
        margin-top: 2px;
        display: block;
    }

    .materi-label {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--sage-400);
        display: block;
    }

    .pengajar-box {
        background: var(--sage-50);
        border: 1px solid var(--sage-200);
        border-top: 2px solid var(--teal-500);
        border-radius: 10px;
        padding: 0.7rem 0.9rem;
        min-width: 180px;
    }

    .badge-page-header {
        background: rgba(201, 168, 76, 0.18);
        color: var(--gold-200);
        font-size: 0.65rem;
        padding: 0.3rem 0.85rem;
        border-radius: 99px;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        display: inline-block;
    }

    @media (min-width: 640px) {
        .katekisasi-card { flex-direction: row; align-items: center; }
    }
</style>

{{-- ════════ PAGE HEADER ════════ --}}
<div style="background: linear-gradient(145deg, var(--sage-950) 0%, var(--sage-800) 55%, var(--teal-700) 100%); padding: 3.5rem 1.5rem 3rem; border-bottom: 1px solid rgba(255,255,255,0.07);">
    <div style="max-width: 72rem; margin: 0 auto;">
        <span class="badge-page-header">Kelas Pengajaran</span>
        <h1 class="church-serif" style="color: #FDFBF7; font-size: clamp(1.9rem, 4vw, 2.75rem); font-weight: 700; margin: 0.75rem 0 0.5rem; letter-spacing: -0.01em; line-height: 1.15;">
            Jadwal Katekisasi <span style="font-style: italic; color: var(--teal-300);">(Kesasi)</span>
        </h1>
        <p class="church-body" style="color: var(--sage-200); font-size: 0.85rem; max-width: 500px; margin: 0; line-height: 1.65; opacity: 0.85;">
            Informasi waktu pelaksanaan, materi pengajaran sidi/baptis kudus, serta pelayan dan pengajar pendamping di GKS Kanatang.
        </p>
        <div style="margin-top: 1.5rem; display: flex; align-items: center; gap: 0.6rem;">
            <div style="width: 2.5rem; height: 2px; background: var(--gold-500); border-radius: 2px;"></div>
            <div style="width: 0.4rem; height: 0.4rem; background: var(--teal-300); border-radius: 50%;"></div>
            <div style="width: 1rem; height: 2px; background: var(--teal-600); border-radius: 2px;"></div>
        </div>
    </div>
</div>

{{-- ════════ MAIN CONTENT ════════ --}}
<div class="church-body" style="max-width: 72rem; margin: 0 auto; padding: 2.5rem 1.5rem 3rem;">

    <div style="display: flex; flex-direction: column; gap: 1rem;">
        @forelse($jadwal as $j)
        <article class="katekisasi-card">

            {{-- Kotak Tanggal --}}
            <div class="date-badge-teal">
                <span class="day-num">{{ $j->waktu->format('d') }}</span>
                <span class="month-str">{{ $j->waktu->isoFormat('MMM') }}</span>
            </div>

            {{-- Info Materi & Waktu --}}
            <div style="flex: 1; display: flex; flex-direction: column; gap: 0.4rem;">
                <span class="materi-label">Materi Pengajaran</span>
                <p class="church-serif" style="color: #1A2A22; font-size: 1.2rem; font-weight: 700; margin: 0; line-height: 1.25;">
                    {{ $j->materi }}
                </p>

                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.4rem 1rem; margin-top: 0.15rem;">
                    <span style="display: flex; align-items: center; gap: 0.35rem; font-size: 0.78rem; font-weight: 600; color: var(--teal-600);">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ $j->waktu->isoFormat('dddd, D MMMM YYYY') }}
                    </span>
                    <span style="color: var(--sage-200); font-size: 0.75rem;" aria-hidden="true">|</span>
                    <span style="display: flex; align-items: center; gap: 0.35rem; font-size: 0.78rem; font-weight: 600; color: var(--sage-600);">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        {{ $j->waktu->format('H:i') }} WITA
                    </span>
                </div>
            </div>

            {{-- Info Pengajar --}}
            <div style="flex-shrink: 0;">
                <div class="pengajar-box">
                    <p style="font-size: 0.62rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--teal-500); margin: 0 0 0.4rem;">Guru Jemaat / Pengajar</p>
                    <p style="font-size: 0.9rem; font-weight: 700; color: var(--sage-800); margin: 0; display: flex; align-items: center; gap: 0.35rem;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--teal-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                        {{ $j->pengajar->nama_pelayan }}
                    </p>
                </div>
            </div>

        </article>
        @empty
        <div style="background: #FFFFFF; border: 1.5px dashed var(--teal-100); border-radius: 14px; padding: 4rem 2rem; text-align: center;">
            <div style="width: 3.5rem; height: 3.5rem; background: var(--teal-50); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--teal-500)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            </div>
            <p class="church-serif" style="font-size: 1.1rem; font-weight: 700; color: #374151; margin: 0 0 0.4rem;">Belum Ada Jadwal Katekisasi</p>
            <p class="church-body" style="font-size: 0.8rem; color: #9CA3AF; margin: 0;">Jadwal atau materi kelas pengajaran kesasi belum diterbitkan untuk periode ini.</p>
        </div>
        @endforelse
    </div>

    @if($jadwal->hasPages())
    <div style="margin-top: 2rem; background: #FFFFFF; border: 1px solid var(--sage-100); border-radius: 12px; padding: 1rem 1.25rem; box-shadow: 0 1px 4px rgba(30,70,50,0.05);">
        {{ $jadwal->links() }}
    </div>
    @endif

</div>

@endsection