@extends('layouts.public')
@section('title', 'Beranda')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lato:ital,wght@0,300;0,400;0,700;1,400&display=swap');

    :root {
        --forest:   #0e2a1a;
        --pine:     #143222;
        --fern:     #1f4d34;
        --leaf:     #2a6645;
        --gold:     #c9a84c;
        --gold-lt:  #e8c87a;
        --cream:    #f5f0e8;
        --stone:    #8a7e6e;
    }

    * { box-sizing: border-box; }

    body { font-family: 'Lato', sans-serif; background: var(--cream); }

    /* ─── HERO ─────────────────────────────────── */
    .hero {
        position: relative;
        background: linear-gradient(155deg, var(--forest) 0%, var(--fern) 60%, #183d28 100%);
        color: #fff;
        overflow: hidden;
        padding: 80px 0 90px;
    }
    .hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    /* Diagonal gold accent bar */
    .hero::after {
        content: '';
        position: absolute;
        top: -60px; right: -80px;
        width: 420px; height: 420px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(201,168,76,.18) 0%, transparent 65%);
        pointer-events: none;
    }

    .hero-inner {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 24px;
        text-align: center;
        position: relative; z-index: 2;
    }

    /* animated cross */
    .cross-wrap {
        display: inline-flex;
        align-items: center; justify-content: center;
        width: 64px; height: 64px;
        background: rgba(201,168,76,.15);
        border: 1px solid rgba(201,168,76,.4);
        border-radius: 16px;
        margin-bottom: 24px;
        animation: pulse-gold 3s ease-in-out infinite;
    }
    @keyframes pulse-gold {
        0%,100%{ box-shadow: 0 0 0 0 rgba(201,168,76,.35); }
        50%    { box-shadow: 0 0 0 12px rgba(201,168,76,0); }
    }
    .cross-icon { color: var(--gold); width: 36px; height: 36px; }

    .hero-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(201,168,76,.15);
        border: 1px solid rgba(201,168,76,.35);
        color: var(--gold-lt);
        font-family: 'Lato', sans-serif;
        font-size: 10px; font-weight: 700;
        letter-spacing: .14em; text-transform: uppercase;
        padding: 6px 18px; border-radius: 999px;
        margin-bottom: 18px;
    }

    .hero h1 {
        font-family: 'Cinzel', serif;
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 900;
        line-height: 1.1;
        letter-spacing: -.01em;
        margin: 0 0 16px;
        background: linear-gradient(135deg, #fff 40%, var(--gold-lt));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-sub {
        color: rgba(255,255,255,.72);
        font-size: 15px; line-height: 1.7;
        max-width: 520px; margin: 0 auto 32px;
        font-weight: 300;
    }

    .hero-actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

    .btn-gold {
        background: linear-gradient(135deg, var(--gold) 0%, #a8873a 100%);
        color: var(--forest);
        font-weight: 800; font-size: 13px;
        padding: 14px 28px; border-radius: 12px;
        text-decoration: none; display: inline-flex; align-items: center; gap-: 8px;
        gap: 8px;
        transition: transform .2s, box-shadow .2s;
        box-shadow: 0 4px 20px rgba(201,168,76,.4);
        border: none;
    }
    .btn-gold:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(201,168,76,.5); color: var(--forest); }

    .btn-ghost {
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.25);
        color: #fff; font-weight: 700; font-size: 13px;
        padding: 14px 28px; border-radius: 12px;
        text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
        transition: background .2s, transform .2s;
        backdrop-filter: blur(6px);
    }
    .btn-ghost:hover { background: rgba(255,255,255,.2); transform: translateY(-2px); color: #fff; }

    /* ─── STATS ROW ─────────────────────────────── */
    .stats-strip {
        background: var(--pine);
        padding: 0;
        overflow: hidden;
    }
    .stats-inner {
        max-width: 900px; margin: 0 auto;
        display: grid; grid-template-columns: repeat(4, 1fr);
    }
    .stat-item {
        text-align: center;
        padding: 20px 16px;
        border-right: 1px solid rgba(255,255,255,.1);
        position: relative;
        cursor: default;
        transition: background .25s;
    }
    .stat-item:last-child { border-right: none; }
    .stat-item:hover { background: rgba(255,255,255,.06); }
    .stat-num {
        font-family: 'Cinzel', serif;
        font-size: 1.7rem; font-weight: 700;
        color: var(--gold);
        line-height: 1;
        display: block;
    }
    .stat-label {
        font-size: 10px; font-weight: 700;
        color: rgba(255,255,255,.55);
        text-transform: uppercase; letter-spacing: .1em;
        margin-top: 5px; display: block;
    }

    /* ─── MAIN CONTENT ──────────────────────────── */
    .main-wrap {
        max-width: 960px; margin: 0 auto;
        padding: 52px 24px 64px;
    }

    /* ─── SECTION HEADER ────────────────────────── */
    .sec-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 2px solid transparent;
        border-image: linear-gradient(90deg, var(--pine) 0%, transparent 100%) 1;
    }
    .sec-title {
        display: flex; align-items: center; gap: 10px;
    }
    .sec-title-dot {
        width: 8px; height: 28px;
        background: linear-gradient(180deg, var(--gold), var(--leaf));
        border-radius: 4px; flex-shrink: 0;
    }
    .sec-title h2 {
        font-family: 'Cinzel', serif;
        font-size: .85rem; font-weight: 700;
        color: var(--pine);
        letter-spacing: .06em;
        text-transform: uppercase;
        margin: 0;
    }
    .sec-link {
        font-size: 11px; font-weight: 800;
        color: var(--leaf);
        background: #e8f2ec;
        border: 1px solid #c3dcc9;
        padding: 6px 14px; border-radius: 8px;
        text-decoration: none;
        transition: background .2s, color .2s;
        letter-spacing: .04em;
    }
    .sec-link:hover { background: var(--leaf); color: #fff; }

    /* ─── CARDS GRID ────────────────────────────── */
    .cards-grid { display: grid; gap: 14px; }

    /* ─── EVENT CARD ────────────────────────────── */
    .ev-card {
        background: #fff;
        border: 1px solid #e6e0d6;
        border-radius: 18px;
        padding: 16px 18px;
        display: flex; align-items: flex-start; gap: 14px;
        box-shadow: 0 2px 8px rgba(20,50,34,.05);
        transition: transform .2s, box-shadow .2s, border-color .2s;
        position: relative;
        overflow: hidden;
    }
    .ev-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--pine), var(--gold));
        transform: scaleX(0); transform-origin: left;
        transition: transform .3s ease;
    }
    .ev-card:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(20,50,34,.1); border-color: #c3dcc9; }
    .ev-card:hover::before { transform: scaleX(1); }

    /* Date badge */
    .date-badge {
        min-width: 54px; height: 58px;
        border-radius: 12px;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        flex-shrink: 0;
        border: 1px solid rgba(0,0,0,.06);
    }
    .date-badge .dd {
        font-size: 1.25rem; font-weight: 900; line-height: 1;
        font-family: 'Cinzel', serif;
    }
    .date-badge .mm {
        font-size: 9px; font-weight: 800;
        text-transform: uppercase; letter-spacing: .1em;
        color: var(--stone); margin-top: 3px;
    }

    .badge-green  { background: #eef7f1; color: var(--pine); }
    .badge-amber  { background: #fef8ec; color: #7a5c1a; }
    .badge-blue   { background: #eef2ff; color: #2d3da8; }
    .badge-rose   { background: #fef2f2; color: #9f2424; }

    .ev-body { flex: 1; min-width: 0; }
    .ev-title {
        font-weight: 800; font-size: 14px;
        color: #1a1a1a; margin: 0 0 6px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .ev-meta {
        display: flex; flex-wrap: wrap; gap: 10px;
        font-size: 11px; font-weight: 700; color: var(--stone);
    }
    .ev-meta span { display: flex; align-items: center; gap: 4px; }
    .ev-meta .green  { color: var(--leaf); }
    .ev-meta .amber  { color: #9a6f20; }
    .ev-meta .blue   { color: #3d4fd4; }

    .ev-footer {
        margin-top: 10px; padding-top: 10px;
        border-top: 1px solid #f0ebe3;
        display: flex; align-items: center; gap: 6px;
    }
    .ev-footer .pelayan-chip {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 11px; font-weight: 700;
        color: #444; background: #f7f4ef;
        border: 1px solid #e8e2d6; border-radius: 8px;
        padding: 4px 10px;
    }
    .ev-footer .pelayan-chip svg { color: var(--stone); }

    /* ─── WARTA CARD ────────────────────────────── */
    .warta-card {
        background: #fff;
        border: 1px solid #e6e0d6;
        border-left: 4px solid var(--pine);
        border-radius: 0 16px 16px 0;
        padding: 16px 18px;
        box-shadow: 0 2px 8px rgba(20,50,34,.05);
        transition: transform .2s, box-shadow .2s, border-left-color .2s;
        min-height: 90px;
        display: flex; flex-direction: column; justify-content: space-between;
    }
    .warta-card:hover { transform: translateX(4px); box-shadow: 0 6px 20px rgba(20,50,34,.1); border-left-color: var(--gold); }

    .warta-date-chip {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 10px; font-weight: 800;
        background: #f5f0e8; color: var(--stone);
        border: 1px solid #e0d9ce;
        padding: 4px 10px; border-radius: 6px;
        text-transform: uppercase; letter-spacing: .07em;
        margin-bottom: 8px;
    }
    .warta-text {
        font-size: 13px; color: #444; line-height: 1.65;
        display: -webkit-box; -webkit-line-clamp: 2;
        -webkit-box-orient: vertical; overflow: hidden;
    }

    /* ─── EMPTY STATE ───────────────────────────── */
    .empty-state {
        background: #fff;
        border: 2px dashed #d8d0c4;
        border-radius: 18px; padding: 40px;
        text-align: center; color: #b0a898;
        font-size: 13px; font-weight: 600;
    }
    .empty-state svg { color: #d8d0c4; margin-bottom: 8px; display: block; margin-left: auto; margin-right: auto; }

    /* ─── 2-col grid for desktop ────────────────── */
    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 52px; }
    @media(max-width:768px){ .two-col { grid-template-columns: 1fr; gap: 40px; } .stats-inner{ grid-template-columns: repeat(2,1fr); } }

    /* ─── SECTION DIVIDER ───────────────────────── */
    .divider {
        border: none;
        height: 1px;
        background: linear-gradient(90deg, transparent, #d0c8bc, transparent);
        margin: 48px 0;
    }

    /* ─── SCROLL REVEAL ─────────────────────────── */
    .reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
    .reveal.visible { opacity: 1; transform: none; }

    /* Stagger children */
    .reveal-stagger > * { opacity: 0; transform: translateY(16px); transition: opacity .4s ease, transform .4s ease; }
    .reveal-stagger.visible > *:nth-child(1){ opacity:1;transform:none;transition-delay:.05s }
    .reveal-stagger.visible > *:nth-child(2){ opacity:1;transform:none;transition-delay:.12s }
    .reveal-stagger.visible > *:nth-child(3){ opacity:1;transform:none;transition-delay:.19s }
    .reveal-stagger.visible > *:nth-child(4){ opacity:1;transform:none;transition-delay:.26s }

    /* ─── TICKER ────────────────────────────────── */
    .ticker-wrap {
        background: var(--forest);
        border-top: 1px solid rgba(201,168,76,.25);
        border-bottom: 1px solid rgba(201,168,76,.25);
        overflow: hidden; padding: 10px 0;
    }
    .ticker-inner {
        display: flex; gap: 48px;
        animation: ticker 28s linear infinite;
        white-space: nowrap;
        width: max-content;
    }
    .ticker-inner:hover { animation-play-state: paused; }
    @keyframes ticker { from{ transform: translateX(0) } to{ transform: translateX(-50%) } }
    .ticker-item {
        font-size: 11px; font-weight: 700;
        color: var(--gold-lt); letter-spacing: .07em;
        text-transform: uppercase;
        display: inline-flex; align-items: center; gap: 8px;
    }
    .ticker-dot { width: 4px; height: 4px; background: var(--gold); border-radius: 50%; flex-shrink: 0; }
</style>

<!-- ░░░ HERO ░░░ -->
<section class="hero">
    <div class="hero-inner">
        <div class="cross-wrap">
            <svg class="cross-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                <path d="M12 2v20M2 8h20"/>
            </svg>
        </div>
        <div class="hero-badge">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            Teknologi Informasi Pelayanan Jemaat
        </div>
        <h1>GKS Jemaat Kanatang</h1>
        <p class="hero-sub">Membangun persekutuan yang transparan, terintegrasi, dan bertumbuh bersama dalam pelayanan firman Tuhan di Sumba Timur.</p>
        <div class="hero-actions">
            <a href="{{ route('public.jadwal-ibadah') }}" class="btn-gold">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Jadwal Ibadah Minggu
            </a>
            <a href="{{ route('public.wartamimbar') }}" class="btn-ghost">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z"/></svg>
                Baca Warta Mimbar
            </a>
        </div>
    </div>
</section>

<!-- ░░░ TICKER ░░░ -->
<div class="ticker-wrap">
    <div class="ticker-inner" id="ticker">
        <span class="ticker-item"><span class="ticker-dot"></span>Selamat datang di Sistem Informasi GKS Kanatang</span>
        <span class="ticker-item"><span class="ticker-dot"></span>Jadwal ibadah, PA, dan katekisasi tersedia setiap minggu</span>
        <span class="ticker-item"><span class="ticker-dot"></span>Warta mimbar terbaru selalu diperbarui secara berkala</span>
        <span class="ticker-item"><span class="ticker-dot"></span>Tuhan memberkati pelayanan kita bersama</span>
        <!-- duplkat untuk seamless loop -->
        <span class="ticker-item"><span class="ticker-dot"></span>Selamat datang di Sistem Informasi GKS Kanatang</span>
        <span class="ticker-item"><span class="ticker-dot"></span>Jadwal ibadah, PA, dan katekisasi tersedia setiap minggu</span>
        <span class="ticker-item"><span class="ticker-dot"></span>Warta mimbar terbaru selalu diperbarui secara berkala</span>
        <span class="ticker-item"><span class="ticker-dot"></span>Tuhan memberkati pelayanan kita bersama</span>
    </div>
</div>

<!-- ░░░ STATS STRIP ░░░ -->
<div class="stats-strip">
    <div class="stats-inner">
        <div class="stat-item">
            <span class="stat-num" data-target="{{ $ibadah->count() ?? 0 }}">0</span>
            <span class="stat-label">Jadwal Ibadah</span>
        </div>
        <div class="stat-item">
            <span class="stat-num" data-target="{{ $pa->count() ?? 0 }}">0</span>
            <span class="stat-label">Jadwal PA</span>
        </div>
        <div class="stat-item">
            <span class="stat-num" data-target="{{ $kesasi->count() ?? 0 }}">0</span>
            <span class="stat-label">Katekisasi</span>
        </div>
        <div class="stat-item">
            <span class="stat-num" data-target="{{ $warta->count() ?? 0 }}">0</span>
            <span class="stat-label">Warta Mimbar</span>
        </div>
    </div>
</div>

<!-- ░░░ MAIN CONTENT ░░░ -->
<div class="main-wrap">

    <!-- ROW 1: Ibadah + PA -->
    <div class="two-col">

        {{-- IBADAH MINGGU --}}
        <div class="reveal">
            <div class="sec-header">
                <div class="sec-title">
                    <div class="sec-title-dot"></div>
                    <h2>Jadwal Ibadah</h2>
                </div>
                <a href="{{ route('public.jadwal-ibadah') }}" class="sec-link">Lihat Semua </a>
            </div>
            <div class="cards-grid reveal-stagger">
                @forelse($ibadah as $j)
                <div class="ev-card">
                    <div class="date-badge badge-green">
                        <span class="dd">{{ $j->waktu->format('d') }}</span>
                        <span class="mm">{{ $j->waktu->isoFormat('MMM') }}</span>
                    </div>
                    <div class="ev-body">
                        <p class="ev-title">{{ $j->ayat_bacaan }}</p>
                        <div class="ev-meta">
                            <span class="green">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                {{ $j->waktu->format('H:i') }} WITA
                            </span>
                            <span>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $j->lokasi }}
                            </span>
                        </div>
                        <div class="ev-footer">
                            <span class="pelayan-chip">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                {{ $j->pelayan->nama_pelayan }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Belum ada jadwal ibadah terdekat.
                </div>
                @endforelse
            </div>
        </div>

        {{-- JADWAL PA --}}
        <div class="reveal" style="transition-delay:.1s">
            <div class="sec-header">
                <div class="sec-title">
                    <div class="sec-title-dot" style="background:linear-gradient(180deg,#c9a84c,#e8a020)"></div>
                    <h2>Jadwal Pelayanan PA</h2>
                </div>
                <a href="{{ route('public.jadwal-pa') }}" class="sec-link">Lihat Semua </a>
            </div>
            <div class="cards-grid reveal-stagger">
                @forelse($pa as $j)
                <div class="ev-card">
                    <div class="date-badge badge-amber">
                        <span class="dd">{{ $j->waktu->format('d') }}</span>
                        <span class="mm">{{ $j->waktu->isoFormat('MMM') }}</span>
                    </div>
                    <div class="ev-body">
                        <p class="ev-title">PA: {{ $j->nama_penerima_pa }}</p>
                        <div class="ev-meta">
                            <span>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                {{ $j->wilayah->nama_wilayah }}
                            </span>
                            <span class="amber" style="color:#9a6f20">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                                Nats: <em>{{ $j->ayat }}</em>
                            </span>
                        </div>
                        <div class="ev-footer">
                            <span class="pelayan-chip">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                {{ $j->pelayan->nama_pelayan }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                    Belum ada jadwal PA terdekat.
                </div>
                @endforelse
            </div>
        </div>

    </div>

    <hr class="divider">

    <!-- ROW 2: Katekisasi + Warta -->
    <div class="two-col">

        {{-- KATEKISASI --}}
        <div class="reveal">
            <div class="sec-header">
                <div class="sec-title">
                    <div class="sec-title-dot" style="background:linear-gradient(180deg,#3b5bdb,#74c0fc)"></div>
                    <h2>Jadwal Katekisasi</h2>
                </div>
                <a href="{{ route('public.jadwal-kesasi') }}" class="sec-link">Lihat Semua </a>
            </div>
            <div class="cards-grid reveal-stagger">
                @forelse($kesasi as $j)
                <div class="ev-card">
                    <div class="date-badge badge-blue">
                        <span class="dd">{{ $j->waktu->format('d') }}</span>
                        <span class="mm">{{ $j->waktu->isoFormat('MMM') }}</span>
                    </div>
                    <div class="ev-body">
                        <p class="ev-title">{{ $j->materi }}</p>
                        <div class="ev-meta">
                            <span class="blue" style="color:#3d4fd4">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                Pengajar: {{ $j->pengajar->nama_pelayan }}
                            </span>
                            <span>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                {{ $j->waktu->format('H:i') }} WITA
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    Belum ada jadwal katekisasi.
                </div>
                @endforelse
            </div>
        </div>

        {{-- WARTA MIMBAR --}}
        <div class="reveal" style="transition-delay:.1s">
            <div class="sec-header">
                <div class="sec-title">
                    <div class="sec-title-dot" style="background:linear-gradient(180deg,#b91c1c,#f87171)"></div>
                    <h2>Warta Mimbar Terkini</h2>
                </div>
                <a href="{{ route('public.wartamimbar') }}" class="sec-link">Lihat Semua </a>
            </div>
            <div class="cards-grid reveal-stagger">
                @forelse($warta as $w)
                <div class="warta-card">
                    <div>
                        <div class="warta-date-chip">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ $w->tanggal->isoFormat('D MMMM YYYY') }}
                        </div>
                        <p class="warta-text">{{ $w->informasi }}</p>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51"/></svg>
                    Belum ada pengumuman warta mimbar.
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script>
// ─── Counter animation ──────────────────────────────
function animateCounter(el) {
    const target = +el.dataset.target;
    if (target === 0) { el.textContent = '0'; return; }
    const duration = 900;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = Math.round(current);
        if (current >= target) clearInterval(timer);
    }, 16);
}

const statNums = document.querySelectorAll('.stat-num[data-target]');
const statObserver = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { animateCounter(e.target); statObserver.unobserve(e.target); }
    });
}, { threshold: .5 });
statNums.forEach(n => statObserver.observe(n));

// ─── Scroll reveal ──────────────────────────────────
const revealEls = document.querySelectorAll('.reveal, .reveal-stagger');
const revealObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); revealObs.unobserve(e.target); }
    });
}, { threshold: .12 });
revealEls.forEach(el => revealObs.observe(el));
</script>

@endsection