@extends('layouts.public')
@section('title', 'Warta Mimbar')
@section('content')

{{-- ═══════════════════════════════════════════════════════════════
     TEMA: Deep Sage / Emerald — GKS Kanatang (Warta Mimbar)
     Nuansa: Elegan editorial — Warta adalah dokumen resmi jemaat.
     Tampilan lebih luas/editorial, aksen emas untuk resmi/institusional.
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
        --gold-700: #7A5C1A;
        --gold-600: #9C7A28;
        --gold-500: #C9A84C;
        --gold-400: #DDB85A;
        --gold-200: #F0D89A;
        --gold-100: #FAF0D7;
        --gold-50:  #FEFBF0;
    }

    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,400;0,600;1,400&family=Source+Sans+3:wght@400;500;600;700&display=swap');

    .church-serif  { font-family: 'Cormorant Garamond', 'Georgia', serif; }
    .church-body   { font-family: 'Source Sans 3', 'Segoe UI', sans-serif; }
    .church-crimson{ font-family: 'Crimson Pro', 'Georgia', serif; }

    .warta-card {
        background: #FFFFFF;
        border: 1px solid var(--sage-100);
        border-left: 4px solid var(--gold-500);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 8px rgba(30, 70, 50, 0.06), 0 4px 20px rgba(30, 70, 50, 0.04);
        transition: box-shadow 0.2s ease, transform 0.15s ease;
    }
    .warta-card:hover {
        box-shadow: 0 4px 24px rgba(30, 70, 50, 0.12), 0 8px 40px rgba(30, 70, 50, 0.07);
        transform: translateY(-1px);
    }

    .warta-header {
        background: linear-gradient(to right, var(--sage-50), #FAFCFB);
        border-bottom: 1px solid var(--sage-100);
        padding: 0.9rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .warta-date-badge {
        background: var(--sage-800);
        color: var(--sage-100);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.3rem 0.9rem;
        border-radius: 99px;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        letter-spacing: 0.03em;
    }

    .ibadah-block {
        background: var(--sage-50);
        border: 1px solid var(--sage-150);
        border-radius: 10px;
        padding: 0.9rem 1.1rem;
        max-width: 36rem;
    }

    .ibadah-block-label {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--sage-500);
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-bottom: 0.5rem;
    }

    .informasi-block {
        background: var(--gold-50);
        border: 1px solid var(--gold-100);
        border-radius: 10px;
        padding: 1.1rem 1.3rem;
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

    .warta-content {
        padding: 1.25rem 1.5rem 1.4rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    /* Divider ornamen sederhana */
    .warta-divider {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin: 0.15rem 0;
    }
    .warta-divider::before,
    .warta-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--sage-150);
    }
</style>

{{-- ════════ PAGE HEADER ════════ --}}
<div style="background: linear-gradient(145deg, var(--sage-950) 0%, var(--sage-800) 60%, var(--sage-700) 100%); padding: 3.5rem 1.5rem 3rem; border-bottom: 1px solid rgba(255,255,255,0.07);">
    <div style="max-width: 72rem; margin: 0 auto;">
        <span class="badge-page-header">Pengumuman Jemaat</span>
        <h1 class="church-serif" style="color: #FDFBF7; font-size: clamp(1.9rem, 4vw, 2.75rem); font-weight: 700; margin: 0.75rem 0 0.5rem; letter-spacing: -0.01em; line-height: 1.15;">
            Warta Mimbar <span style="font-style: italic; color: var(--gold-200);">Terkini</span>
        </h1>
        <p class="church-body" style="color: var(--sage-200); font-size: 0.85rem; max-width: 500px; margin: 0; line-height: 1.65; opacity: 0.85;">
            Laporan pengumuman mingguan, mutasi jemaat, keuangan, serta pemberitahuan resmi dari majelis jemaat GKS Kanatang.
        </p>
        <div style="margin-top: 1.5rem; display: flex; align-items: center; gap: 0.6rem;">
            <div style="width: 2.5rem; height: 2px; background: var(--gold-500); border-radius: 2px;"></div>
            <div style="width: 0.4rem; height: 0.4rem; background: var(--gold-400); border-radius: 50%;"></div>
            <div style="width: 1rem; height: 2px; background: var(--sage-500); border-radius: 2px;"></div>
        </div>
    </div>
</div>

{{-- ════════ MAIN CONTENT ════════ --}}
<div class="church-body" style="max-width: 72rem; margin: 0 auto; padding: 2.5rem 1.5rem 3rem;">

    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        @forelse($warta as $w)
        <article class="warta-card">

            {{-- Header Warta --}}
            <div class="warta-header">
                <div class="warta-date-badge">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3H6a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3 3 3 0 0 0-3 3 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/></svg>
                    Warta Hari {{ $w->tanggal->isoFormat('dddd, D MMMM YYYY') }}
                </div>
                {{-- Ornamen nomor warta / edisi --}}
                <span style="font-size: 0.7rem; color: var(--sage-400); font-weight: 600; font-style: italic;">
                    GKS Kanatang
                </span>
            </div>

            {{-- Konten Dalam --}}
            <div class="warta-content">

                {{-- Blok Keterkaitan Ibadah (jika ada) --}}
                @if($w->ibadah)
                <div class="ibadah-block">
                    <p class="ibadah-block-label">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Keterkaitan Ibadah Minggu
                    </p>
                    <div style="display: flex; flex-direction: column; gap: 0.35rem;">
                        <p class="church-serif" style="font-size: 1rem; font-weight: 700; color: var(--sage-800); margin: 0; line-height: 1.2;">
                            {{ $w->ibadah->waktu->isoFormat('dddd, D MMMM YYYY') }}
                            <span style="color: var(--sage-500); font-weight: 600; font-size: 0.9rem;">
                                — {{ $w->ibadah->waktu->format('H:i') }} WITA
                            </span>
                        </p>
                        <p class="church-body" style="font-size: 0.78rem; color: var(--sage-600); margin: 0; display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            <span>Nats:</span>
                            <span style="font-style: italic; font-weight: 600; color: var(--sage-700);">{{ $w->ibadah->ayat_bacaan }}</span>
                        </p>
                        <p class="church-body" style="font-size: 0.78rem; color: #6B7280; margin: 0; display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            Lokasi: <span style="font-weight: 600; color: var(--sage-700);">{{ $w->ibadah->lokasi }}</span>
                        </p>
                    </div>
                </div>
                @endif

                {{-- Divider ornamen tipis --}}
                @if($w->ibadah)
                <div class="warta-divider">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="var(--sage-200)" stroke="none" aria-hidden="true"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
                </div>
                @endif

                {{-- Isi Informasi / Warta --}}
                <div class="informasi-block">
                    <p style="font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: var(--gold-600); margin: 0 0 0.6rem; display: flex; align-items: center; gap: 0.4rem;">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
                        Pengumuman &amp; Informasi Jemaat
                    </p>
                    <div class="church-crimson" style="color: #2D3748; font-size: 0.98rem; line-height: 1.8; white-space: pre-line; text-align: justify; letter-spacing: 0.01em;">
                        {{ $w->informasi }}
                    </div>
                </div>

            </div>
        </article>
        @empty
        <div style="background: #FFFFFF; border: 1.5px dashed var(--gold-200); border-radius: 16px; padding: 4rem 2rem; text-align: center;">
            <div style="width: 3.5rem; height: 3.5rem; background: var(--gold-50); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--gold-500)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
            </div>
            <p class="church-serif" style="font-size: 1.1rem; font-weight: 700; color: #374151; margin: 0 0 0.4rem;">Belum Ada Warta Mimbar</p>
            <p class="church-body" style="font-size: 0.8rem; color: #9CA3AF; margin: 0;">Belum ada dokumen pengumuman warta mimbar yang diunggah oleh sekretariat jemaat.</p>
        </div>
        @endforelse
    </div>

    @if($warta->hasPages())
    <div style="margin-top: 2rem; background: #FFFFFF; border: 1px solid var(--sage-100); border-radius: 12px; padding: 1rem 1.25rem; box-shadow: 0 1px 4px rgba(30,70,50,0.05);">
        {{ $warta->links() }}
    </div>
    @endif

</div>

@endsection