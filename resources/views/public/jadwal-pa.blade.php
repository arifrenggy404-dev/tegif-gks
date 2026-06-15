@extends('layouts.public')
@section('title', 'Jadwal Pelayanan PA')
@section('content')

{{-- ═══════════════════════════════════════════════════════════════
     TEMA: Deep Sage / Emerald — GKS Kanatang (Jadwal PA)
     Aksen khusus: Amber/Kuning-emas untuk badge wilayah PA
     (kontras hangat di atas base hijau tua yang sejuk)
═══════════════════════════════════════════════════════════════ --}}

<style>
    :root {
        --sage-950: #0B1C12;
        --sage-900: #122218;
        --sage-800: #1A3324;
        --sage-700: #214A32;
        --sage-600: #2E6347;
        --sage-500: #3D7E5A;
        --sage-400: #52A076;
        --sage-300: #7DC49B;
        --sage-200: #B0DFCA;
        --sage-150: #CBF0DC;
        --sage-100: #D8F0E5;
        --sage-50:  #EEF8F3;
        --amber-700: #92540A;
        --amber-600: #B45309;
        --amber-500: #D97706;
        --amber-400: #F59E0B;
        --amber-200: #FCD34D;
        --amber-100: #FEF3C7;
        --amber-50:  #FFFBEB;
        --gold-500: #C9A84C;
        --gold-200: #F0D89A;
    }

    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Source+Sans+3:wght@400;500;600;700&display=swap');

    .church-serif { font-family: 'Cormorant Garamond', 'Georgia', serif; }
    .church-body  { font-family: 'Source Sans 3', 'Segoe UI', sans-serif; }

    .pa-card {
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
    .pa-card:hover {
        box-shadow: 0 4px 20px rgba(30, 70, 50, 0.12), 0 8px 32px rgba(30, 70, 50, 0.06);
        transform: translateY(-1px);
    }

    .date-badge-amber {
        background: var(--amber-50);
        border: 1.5px solid var(--amber-100);
        border-radius: 10px;
        min-width: 68px;
        text-align: center;
        padding: 0.6rem 0.75rem;
        flex-shrink: 0;
    }
    .date-badge-amber .day-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
        color: var(--amber-700);
        display: block;
    }
    .date-badge-amber .month-str {
        font-family: 'Source Sans 3', sans-serif;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--amber-500);
        margin-top: 2px;
        display: block;
    }

    .wilayah-badge {
        background: var(--sage-800);
        color: var(--sage-100);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 0.25rem 0.65rem;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .ayat-box-amber {
        background: var(--amber-50);
        border: 1px solid var(--amber-100);
        border-left: 3px solid var(--amber-400);
        border-radius: 8px;
        padding: 0.5rem 0.8rem;
        display: inline-flex;
        align-items: flex-start;
        gap: 0.45rem;
        max-width: 100%;
    }

    .pelayan-box-pa {
        background: var(--sage-50);
        border: 1px solid var(--sage-200);
        border-top: 2px solid var(--amber-400);
        border-radius: 10px;
        padding: 0.65rem 0.9rem;
        min-width: 190px;
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
        .pa-card { flex-direction: row; align-items: center; }
    }
</style>

{{-- ════════ PAGE HEADER ════════ --}}
<div style="background: linear-gradient(145deg, var(--sage-950) 0%, var(--sage-800) 65%, var(--sage-700) 100%); padding: 3.5rem 1.5rem 3rem; border-bottom: 1px solid rgba(255,255,255,0.07);">
    <div style="max-width: 72rem; margin: 0 auto;">
        <span class="badge-page-header">Persekutuan &amp; Wilayah</span>
        <h1 class="church-serif" style="color: #FDFBF7; font-size: clamp(1.9rem, 4vw, 2.75rem); font-weight: 700; margin: 0.75rem 0 0.5rem; letter-spacing: -0.01em; line-height: 1.15;">
            Jadwal Pelayanan <span style="font-style: italic; color: var(--amber-200);">PA</span>
        </h1>
        <p class="church-body" style="color: var(--sage-200); font-size: 0.85rem; max-width: 520px; margin: 0; line-height: 1.65; opacity: 0.85;">
            Daftar waktu Penelaahan Alkitab (PA), lokasi rumah penerima, wilayah jemaat, nats pembacaan, serta pelayan firman di GKS Kanatang.
        </p>
        <div style="margin-top: 1.5rem; display: flex; align-items: center; gap: 0.6rem;">
            <div style="width: 2.5rem; height: 2px; background: var(--gold-500); border-radius: 2px;"></div>
            <div style="width: 0.4rem; height: 0.4rem; background: var(--amber-200); border-radius: 50%;"></div>
            <div style="width: 1rem; height: 2px; background: var(--sage-500); border-radius: 2px;"></div>
        </div>
    </div>
</div>

{{-- ════════ MAIN CONTENT ════════ --}}
<div class="church-body" style="max-width: 72rem; margin: 0 auto; padding: 2.5rem 1.5rem 3rem;">

    <div style="display: flex; flex-direction: column; gap: 1rem;">
        @forelse($jadwal as $j)
        <article class="pa-card">

            {{-- Kotak Tanggal --}}
            <div class="date-badge-amber">
                <span class="day-num">{{ $j->waktu->format('d') }}</span>
                <span class="month-str">{{ $j->waktu->isoFormat('MMM') }}</span>
            </div>

            {{-- Info Tengah --}}
            <div style="flex: 1; display: flex; flex-direction: column; gap: 0.45rem;">
                {{-- Baris Wilayah + Jam --}}
                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem;">
                    <span class="wilayah-badge">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        {{ $j->wilayah->nama_wilayah }}
                    </span>
                    <span style="display: flex; align-items: center; gap: 0.3rem; font-size: 0.75rem; font-weight: 600; color: var(--sage-600);">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        {{ $j->waktu->format('H:i') }} WITA
                    </span>
                </div>

                {{-- Nama Penerima PA --}}
                <p class="church-serif" style="color: #1A2A22; font-size: 1.15rem; font-weight: 700; margin: 0; line-height: 1.2;">
                    {{ $j->nama_penerima_pa }}
                </p>

                {{-- Ayat --}}
                <div class="ayat-box-amber">
                    <svg width="13" height="13" style="flex-shrink:0; margin-top:1px; color: var(--amber-600);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    <span style="font-style: italic; font-size: 0.8rem; color: var(--amber-700); letter-spacing: 0.01em; line-height: 1.5;">{{ $j->ayat }}</span>
                </div>
            </div>

            {{-- Info Pelayan (Kanan) --}}
            <div style="flex-shrink: 0;">
                <div class="pelayan-box-pa">
                    <p style="font-size: 0.62rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--sage-400); margin: 0 0 0.4rem;">Pelayan Firman</p>
                    <p style="font-size: 0.88rem; font-weight: 700; color: var(--sage-800); margin: 0 0 0.3rem; display: flex; align-items: center; gap: 0.3rem;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--sage-500)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        {{ $j->pelayan->nama_pelayan }}
                    </p>
                    <p style="font-size: 0.72rem; color: #6B7280; margin: 0;">
                        Pendamping: <span style="font-weight: 600; color: var(--sage-600);">{{ $j->pendamping->nama_pelayan }}</span>
                    </p>
                </div>
            </div>

        </article>
        @empty
        <div style="background: #FFFFFF; border: 1.5px dashed var(--amber-200); border-radius: 14px; padding: 4rem 2rem; text-align: center;">
            <div style="width: 3.5rem; height: 3.5rem; background: var(--amber-50); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--amber-500)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
            </div>
            <p class="church-serif" style="font-size: 1.1rem; font-weight: 700; color: #374151; margin: 0 0 0.4rem;">Belum Ada Jadwal PA</p>
            <p class="church-body" style="font-size: 0.8rem; color: #9CA3AF; margin: 0;">Jadwal penelaahan alkitab kategorial wilayah belum dirilis untuk bulan ini.</p>
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