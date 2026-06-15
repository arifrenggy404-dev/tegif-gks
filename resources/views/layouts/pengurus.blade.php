<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKS Kanatang | @yield('title', 'Dashboard Pengurus')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        :root {
            --sidebar-dark:   #0d2118;
            --sidebar-base:   #112a1e;
            --sidebar-hover:  #1a3d2b;
            --sidebar-active: #1f4d34;
            --gold:           #c9a84c;
            --gold-light:     #e8c97a;
            --gold-pale:      rgba(201,168,76,.12);
            --cream:          #f5f7f4;
            --border-subtle:  rgba(255,255,255,.06);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--cream);
        }

        /* ── Scrollbar ──────────────────────── */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(201,168,76,.25); border-radius: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: rgba(201,168,76,.5); }

        /* ── Sidebar ────────────────────────── */
        #sidebar {
            width: 256px;
            background: var(--sidebar-base);
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            left: 0; top: 0;
            z-index: 50;
            transition: transform .3s cubic-bezier(.4,0,.2,1);
            box-shadow: 4px 0 24px rgba(0,0,0,.25);
        }

        /* ── Brand ──────────────────────────── */
        .sidebar-brand {
            background: var(--sidebar-dark);
            padding: 1.35rem 1.5rem 1.25rem;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }
        .sidebar-brand::after {
            content: '';
            position: absolute;
            top: -30px; right: -30px;
            width: 90px; height: 90px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,168,76,.2) 0%, transparent 70%);
        }
        .brand-separator {
            height: 2px;
            background: linear-gradient(90deg,
                transparent 0%,
                rgba(255,255,255,.55) 20%,
                #ffffff 50%,
                rgba(255,255,255,.55) 80%,
                transparent 100%
            );
            margin: 1.15rem 0 0;
            border-radius: 1px;
        }
        .brand-inner {
            display: flex;
            align-items: center;
            gap: .75rem;
            position: relative;
            z-index: 1;
        }
        .brand-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, rgba(201,168,76,.3), rgba(201,168,76,.08));
            border: 1.5px solid rgba(201,168,76,.45);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 12px rgba(201,168,76,.15);
        }
        .brand-name {
            font-family: 'Cinzel', serif;
            font-size: .85rem;
            font-weight: 700;
            color: var(--gold-light);
            letter-spacing: .12em;
            line-height: 1.2;
        }
        .brand-sub {
            font-size: .63rem;
            font-weight: 700;
            color: rgba(255,255,255,.5);
            letter-spacing: .22em;
            text-transform: uppercase;
        }

        /* ── Nav group label ────────────────── */
        .nav-group-label {
            font-size: .6rem;
            font-weight: 800;
            letter-spacing: .22em;
            text-transform: uppercase;
            color: rgba(255,255,255,.35);
            padding: 1rem 1.25rem .3rem;
            display: flex;
            align-items: center;
            gap: .6rem;
        }
        .nav-group-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,.08);
            border-radius: 1px;
        }

        /* ── Menu item ──────────────────────── */
        .menu-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .68rem 1rem;
            margin: 0 .6rem;
            border-radius: 10px;
            font-size: .82rem;
            font-weight: 700;
            color: rgba(255,255,255,.62);
            text-decoration: none;
            cursor: pointer;
            transition: background .2s, color .2s, transform .15s;
            position: relative;
        }
        .menu-item:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
            transform: translateX(2px);
        }
        .menu-item.active {
            background: var(--sidebar-active);
            color: #ffffff;
            font-weight: 800;
            box-shadow: inset 0 0 0 1px rgba(201,168,76,.22);
        }
        .menu-item.active::before {
            content: '';
            position: absolute;
            left: -9px; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 18px;
            background: var(--gold);
            border-radius: 0 2px 2px 0;
        }
        .menu-icon {
            width: 18px; height: 18px;
            flex-shrink: 0;
            opacity: .6;
            transition: opacity .2s, transform .2s;
        }
        .menu-item.active .menu-icon { opacity: 1; }
        .menu-item:hover .menu-icon { opacity: .9; transform: scale(1.1); }

        /* ── Read-only badge ─────────────────── */
        .readonly-badge {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            background: var(--gold-pale);
            border: 1px solid rgba(201,168,76,.3);
            color: var(--gold-light);
            font-size: .58rem;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
            padding: .25rem .6rem;
            border-radius: 50px;
            margin: .5rem 1rem 0;
        }

        /* ── Sidebar footer ─────────────────── */
        .sidebar-footer {
            background: var(--sidebar-dark);
            border-top: 1px solid var(--border-subtle);
            padding: .85rem 1rem;
            flex-shrink: 0;
        }
        .user-chip {
            display: flex;
            align-items: center;
            gap: .75rem;
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 10px;
            padding: .65rem .8rem;
        }
        .user-avatar {
            width: 34px; height: 34px;
            border-radius: 8px;
            background: linear-gradient(135deg, #1f4d34, #2d6645);
            border: 1px solid rgba(201,168,76,.3);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .user-role  { font-size: .58rem; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: var(--gold); }
        .user-name  { font-size: .78rem; font-weight: 700; color: #fff; line-height: 1.2; }
        .logout-btn {
            width: 32px; height: 32px;
            background: rgba(239,68,68,.08);
            border: 1px solid rgba(239,68,68,.18);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: background .2s, border-color .2s;
            flex-shrink: 0;
        }
        .logout-btn:hover { background: #ef4444; border-color: #ef4444; }
        .logout-btn:hover svg { color: #fff !important; }

        /* ── Main area ──────────────────────── */
        #main-area {
            margin-left: 256px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left .3s cubic-bezier(.4,0,.2,1);
        }

        /* ── Topbar ─────────────────────────── */
        .topbar {
            background: rgba(255,255,255,.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,.07);
            padding: .85rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: 0 1px 12px rgba(0,0,0,.06);
        }
        .topbar-title {
            font-family: 'Cinzel', serif;
            font-size: .92rem;
            font-weight: 700;
            color: #0d2118;
            letter-spacing: .06em;
        }
        .topbar-sub {
            font-size: .65rem;
            font-weight: 600;
            color: #94a3a0;
            letter-spacing: .15em;
            text-transform: uppercase;
            margin-top: .1rem;
        }
        .status-pill {
            display: flex;
            align-items: center;
            gap: .5rem;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 50px;
            padding: .4rem .9rem;
            font-size: .72rem;
            font-weight: 700;
            color: #059669;
            white-space: nowrap;
        }
        .ping-dot {
            position: relative;
            width: 9px; height: 9px;
        }
        .ping-dot::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: #34d399;
            animation: ping 1.5s cubic-bezier(0,0,.2,1) infinite;
            opacity: .75;
        }
        .ping-dot::after {
            content: '';
            position: absolute;
            inset: 1.5px;
            border-radius: 50%;
            background: #10b981;
        }
        @keyframes ping {
            75%, 100% { transform: scale(1.8); opacity: 0; }
        }

        /* ── Content ─────────────────────────── */
        .main-content {
            flex: 1;
            padding: 2rem;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
        }

        /* ── Mobile overlay ─────────────────── */
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.55);
            z-index: 45;
            backdrop-filter: blur(2px);
        }
        #sidebar-overlay.active { display: block; }

        /* ── Mobile toggle ──────────────────── */
        #mobile-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 38px; height: 38px;
            border-radius: 9px;
            background: #f0f4f2;
            border: 1px solid #dde5e1;
            cursor: pointer;
            margin-right: .75rem;
            transition: background .2s;
        }
        #mobile-toggle:hover { background: #e0ebe5; }

        @media (max-width: 1023px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #main-area { margin-left: 0 !important; }
            #mobile-toggle { display: flex; }
            .main-content { padding: 1.25rem; }
            .topbar { padding: .75rem 1.25rem; }
        }

        /* ── Dashboard content styles ────────── */
        .dashboard-content * { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Select2 override */
        .select2-container--default .select2-selection--single {
            border-color: #d1d5db !important;
            border-radius: .5rem !important;
            height: 40px !important;
            display: flex; align-items: center;
        }
    </style>
</head>

<body>

{{-- ── Sidebar overlay (mobile) ─────────────────────── --}}
<div id="sidebar-overlay"></div>

{{-- ── SIDEBAR ──────────────────────────────────────── --}}
<aside id="sidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="brand-inner">
            <div class="brand-icon">
                <svg width="22" height="22" fill="none" stroke="#c9a84c" stroke-width="1.6" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M7 9h10"/>
                </svg>
            </div>
            <div>
                <div class="brand-name">TEGIF GKS</div>
                <div class="brand-sub">Kanatang</div>
            </div>
        </div>
        {{-- Bright separator between brand and menu --}}
        <div class="brand-separator"></div>
    </div>

    {{-- Badge Read-Only --}}
    <div class="readonly-badge">
        <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v2"/>
        </svg>
        Mode Lihat Saja
    </div>

    {{-- Nav --}}
    <div class="flex-1 sidebar-scroll overflow-y-auto py-3">

        <div class="nav-group-label">Utama</div>
        <nav class="space-y-0.5">
            <a href="{{ route('pengurus.dashboard') }}"
               class="menu-item {{ request()->routeIs('pengurus.dashboard') ? 'active' : '' }}">
                <svg class="menu-icon text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
                </svg>
                Dashboard
            </a>
        </nav>

        <div class="nav-group-label" style="margin-top:.5rem;">Keanggotaan</div>
        <nav class="space-y-0.5">
            <a href="{{ route('pengurus.jemaat.index') }}"
               class="menu-item {{ request()->routeIs('pengurus.jemaat.*') ? 'active' : '' }}">
                <svg class="menu-icon text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Data Jemaat
            </a>

            <a href="{{ route('pengurus.pelayan.index') }}"
               class="menu-item {{ request()->routeIs('pengurus.pelayan.*') ? 'active' : '' }}">
                <svg class="menu-icon text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Pelayan Aktif
            </a>

            <a href="{{ route('pengurus.wilayah.index') }}"
               class="menu-item {{ request()->routeIs('pengurus.wilayah.*') ? 'active' : '' }}">
                <svg class="menu-icon text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Wilayah
            </a>
        </nav>

        <div class="nav-group-label" style="margin-top:.5rem;">Pelayanan & Jadwal</div>
        <nav class="space-y-0.5">
            <a href="{{ route('pengurus.jadwal-ibadah.index') }}"
               class="menu-item {{ request()->routeIs('pengurus.jadwal-ibadah.*') ? 'active' : '' }}">
                <svg class="menu-icon text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Jadwal Ibadah
            </a>

            <a href="{{ route('pengurus.jadwal-pa.index') }}"
               class="menu-item {{ request()->routeIs('pengurus.jadwal-pa.*') ? 'active' : '' }}">
                <svg class="menu-icon text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Jadwal PA
            </a>

            <a href="{{ route('pengurus.jadwal-kesasi.index') }}"
               class="menu-item {{ request()->routeIs('pengurus.jadwal-kesasi.*') ? 'active' : '' }}">
                <svg class="menu-icon text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
                Jadwal Kesasi
            </a>
        </nav>

        <div class="nav-group-label" style="margin-top:.5rem;">Informasi & Aset</div>
        <nav class="space-y-0.5">
            <a href="{{ route('pengurus.wartamimbar.index') }}"
               class="menu-item {{ request()->routeIs('pengurus.wartamimbar.*') ? 'active' : '' }}">
                <svg class="menu-icon text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
                Warta Mimbar
            </a>

            <a href="{{ route('pengurus.asset.index') }}"
               class="menu-item {{ request()->routeIs('pengurus.asset.*') ? 'active' : '' }}">
                <svg class="menu-icon text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h10a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Asset Gereja
            </a>

            {{--
            Menu "User" sengaja tidak ditampilkan untuk Pengurus.
            Kalau pengurus tetap perlu melihat (read-only) daftar user,
            uncomment blok berikut — pastikan route pengurus.user.index sudah
            terdaftar via Route::resource(...)->only(['index','show']).

            <a href="{{ route('pengurus.user.index') }}"
               class="menu-item {{ request()->routeIs('pengurus.user.*') ? 'active' : '' }}">
                <svg class="menu-icon text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="capitalize">User</span>
            </a>
            --}}
        </nav>

    </div>

    {{-- User footer --}}
    <div class="sidebar-footer">
        <div class="user-chip">
            <div class="user-avatar">
                <svg width="16" height="16" fill="none" stroke="rgba(201,168,76,.8)" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <div class="user-role">Pengurus</div>
                <div class="user-name truncate">{{ Auth::user()->nama ?? 'Pengurus' }}</div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                @csrf
                <button type="submit" class="logout-btn" title="Keluar">
                    <svg width="14" height="14" fill="none" stroke="#ef4444" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

</aside>

{{-- ── MAIN AREA ─────────────────────────────────────── --}}
<div id="main-area">

    {{-- Topbar --}}
    <header class="topbar">
        <div style="display:flex;align-items:center;">
            <button id="mobile-toggle" title="Menu">
                <svg width="18" height="18" fill="none" stroke="#1a3d2b" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div>
                <div class="topbar-title">GKS Jemaat Kanatang</div>
                <div class="topbar-sub">Panel Pengurus — Mode Lihat Saja</div>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:.75rem;">
            <div class="status-pill">
                <div class="ping-dot"></div>
                Koneksi Stabil
            </div>
        </div>
    </header>

    {{-- Content --}}
    <main class="main-content dashboard-content">
        @yield('content')
    </main>

</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Mobile sidebar toggle ────────────── */
    const sidebar  = document.getElementById('sidebar');
    const overlay  = document.getElementById('sidebar-overlay');
    const toggle   = document.getElementById('mobile-toggle');

    function openSidebar()  { sidebar.classList.add('open'); overlay.classList.add('active'); }
    function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('active'); }

    toggle.addEventListener('click', () => sidebar.classList.contains('open') ? closeSidebar() : openSidebar());
    overlay.addEventListener('click', closeSidebar);

    /* ── SweetAlert2 toast ─────────────────── */
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        customClass: {
            popup: 'rounded-xl shadow-xl border border-slate-100 text-sm font-semibold'
        },
        didOpen: (t) => {
            t.addEventListener('mouseenter', Swal.stopTimer);
            t.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    @if(session('success'))
        Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
    @endif

    @if(session('error'))
        Toast.fire({ icon: 'error', title: "{{ session('error') }}" });
    @endif

    /* ── Select2 ───────────────────────────── */
    if (jQuery().select2) {
        $('.select2').select2({ width: '100%' });
    }
});
</script>

@stack('scripts')
</body>
</html>
