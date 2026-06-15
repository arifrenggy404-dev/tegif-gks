@extends('layouts.public')
@section('title', 'Jadwal Ibadah Minggu')
@section('content')

{{-- ═══════════════════════════════════════════════════════════════
     TEMA: Deep Sage / Emerald — GKS Kanatang
     Palet Hijau: --sage-950: #0B1C12 | --sage-900: #122218 | --sage-800: #1A3324
                  --sage-700: #214A32 | --sage-600: #2E6347 | --sage-500: #3D7E5A
                  --sage-400: #52A076 | --sage-300: #7DC49B | --sage-200: #B0DFCA
                  --sage-100: #D8F0E5 | --sage-50:  #EEF8F3
     Aksen:       --gold-500: #C9A84C | --gold-400: #DDB85A | --gold-200: #F0D89A
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
        --gold-600: #9C7A28;
        --gold-500: #C9A84C;
        --gold-400: #DDB85A;
        --gold-200: #F0D89A;
        --gold-100: #FAF0D7;
    }

    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,400;0,600;1,400&family=Source+Sans+3:wght@400;500;600;700&display=swap');

    .church-serif   { font-family: 'Cormorant Garamond', 'Georgia', serif; }
    .church-body    { font-family: 'Source Sans 3', 'Segoe UI', sans-serif; }

    .jadwal-card {
        background: #FFFFFF;
        border: 1px solid var(--sage-100);
        border-left: 4px solid var(--sage-600);
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        box-shadow: 0 1px 6px rgba(30, 70, 50, 0.06), 0 4px 16px rgba(30, 70, 50, 0.04);
        transition: box-shadow 0.2s ease, transform 0.15s ease;
    }
    .jadwal-card:hover {
        box-shadow: 0 4px 20px rgba(30, 70, 50, 0.12), 0 8px 32px rgba(30, 70, 50, 0.06);
        transform: translateY(-1px);
    }

    .date-badge {
        background: var(--sage-50);
        border: 1.5px solid var(--sage-200);
        border-radius: 10px;
        min-width: 68px;
        text-align: center;
        padding: 0.6rem 0.75rem;
        flex-shrink: 0;
    }
    .date-badge .day-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
        color: var(--sage-700);
        display: block;
    }
    .date-badge .month-str {
        font-family: 'Source Sans 3', sans-serif;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--sage-400);
        margin-top: 2px;
        display: block;
    }

    .ayat-box {
        background: var(--sage-50);
        border: 1px solid var(--sage-150);
        border-left: 3px solid var(--sage-400);
        border-radius: 8px;
        padding: 0.5rem 0.8rem;
        display: inline-flex;
        align-items: flex-start;
        gap: 0.45rem;
        max-width: 100%;
    }

    .pelayan-box {
        background: var(--sage-50);
        border: 1px solid var(--sage-200);
        border-radius: 10px;
        padding: 0.65rem 0.9rem;
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

    @media (min-width: 768px) {
        .jadwal-card { flex-direction: row; align-items: center; }
        .date-badge { flex-direction: column; justify-content: center; }
    }
</style>

{{-- ════════ PAGE HEADER ════════ --}}
<div style="background: linear-gradient(145deg, var(--sage-950) 0%, var(--sage-800) 60%, var(--sage-700) 100%); padding: 3.5rem 1.5rem 3rem; border-bottom: 1px solid var(--sage-700);">
    <div style="max-width: 72rem; margin: 0 auto;">
        <span class="badge-page-header">Informasi Pelayanan</span>
        <h1 class="church-serif" style="color: #FDFBF7; font-size: clamp(1.9rem, 4vw, 2.75rem); font-weight: 700; margin: 0.75rem 0 0.5rem; letter-spacing: -0.01em; line-height: 1.15;">
            Jadwal Ibadah Minggu
        </h1>
        <p class="church-body" style="color: var(--sage-200); font-size: 0.85rem; max-width: 480px; margin: 0; line-height: 1.65; opacity: 0.85;">
            Daftar waktu ibadah hari Minggu, lokasi gedung, nats pembacaan Alkitab, serta pelayan firman di GKS Kanatang.
        </p>
        {{-- Ornamen garis emas --}}
        <div style="margin-top: 1.5rem; display: flex; align-items: center; gap: 0.6rem;">
            <div style="width: 2.5rem; height: 2px; background: var(--gold-500); border-radius: 2px;"></div>
            <div style="width: 0.4rem; height: 0.4rem; background: var(--gold-400); border-radius: 50%;"></div>
            <div style="width: 1rem; height: 2px; background: var(--sage-500); border-radius: 2px;"></div>
        </div>
    </div>
</div>

{{-- ════════ MAIN CONTENT ════════ --}}
<div class="church-body" style="max-width: 72rem; margin: 0 auto; padding: 2.5rem 1.5rem 3rem;">

    <div style="display: flex; flex-direction: column; gap: 1rem;">
        @forelse($jadwal as $j)
        <article class="jadwal-card">

            {{-- Kotak Tanggal --}}
            <div class="date-badge">
                <span class="day-num">{{ $j->waktu->format('d') }}</span>
                <span class="month-str">{{ $j->waktu->isoFormat('MMM') }}</span>
            </div>

            {{-- Info Tengah --}}
            <div style="flex: 1; display: flex; flex-direction: column; gap: 0.45rem;">
                <p class="church-serif" style="color: #1A2A22; font-size: 1.1rem; font-weight: 700; margin: 0; line-height: 1.2;">
                    {{ $j->waktu->isoFormat('dddd, D MMMM YYYY') }}
                </p>

                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.4rem 1rem;">
                    <span style="display: flex; align-items: center; gap: 0.35rem; font-size: 0.78rem; font-weight: 600; color: var(--sage-600);">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        {{ $j->waktu->format('H:i') }} WITA
                    </span>
                    <span style="color: var(--sage-200); font-size: 0.75rem;" aria-hidden="true">|</span>
                    <span style="display: flex; align-items: center; gap: 0.35rem; font-size: 0.78rem; font-weight: 600; color: #6B7280;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $j->lokasi }}
                    </span>
                </div>

                <div class="ayat-box">
                    <svg width="13" height="13" style="flex-shrink:0; margin-top:1px; color: var(--sage-500);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    <span style="font-style: italic; font-size: 0.8rem; color: var(--sage-700); letter-spacing: 0.01em; line-height: 1.5;">{{ $j->ayat_bacaan }}</span>
                </div>
            </div>

            {{-- Info Pelayan (Kanan) --}}
            <div style="flex-shrink: 0;">
                <div class="pelayan-box" style="min-width: 180px;">
                    <p style="font-size: 0.62rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--sage-400); margin: 0 0 0.35rem;">Pelayan Firman</p>
                    <p style="font-size: 0.88rem; font-weight: 700; color: var(--sage-800); margin: 0 0 0.25rem; display: flex; align-items: center; gap: 0.3rem;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--sage-500);"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        {{ $j->pelayan->nama_pelayan }}
                    </p>
                    <p style="font-size: 0.72rem; color: #6B7280; margin: 0;">
                        Pendamping: <span style="font-weight: 600; color: var(--sage-600);">{{ $j->pendamping->nama_pelayan }}</span>
                    </p>
                </div>
            </div>

        </article>
        @empty
        <div style="background: #FFFFFF; border: 1.5px dashed var(--sage-200); border-radius: 14px; padding: 4rem 2rem; text-align: center;">
            <div style="width: 3.5rem; height: 3.5rem; background: var(--sage-50); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--sage-400)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <p class="church-serif" style="font-size: 1.1rem; font-weight: 700; color: #374151; margin: 0 0 0.4rem;">Belum Ada Jadwal Ibadah</p>
            <p class="church-body" style="font-size: 0.8rem; color: #9CA3AF; margin: 0;">Jadwal ibadah minggu untuk bulan ini belum diterbitkan oleh tata usaha jemaat.</p>
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