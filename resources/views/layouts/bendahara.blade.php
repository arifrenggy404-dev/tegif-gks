<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEGIF-GKS | Bendahara — @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* ── Sidebar & Responsive State ── */
        .sidebar {
            background: linear-gradient(180deg, #064e3b 0%, #065f46 100%);
            transition: transform .3s cubic-bezier(.4, 0, .2, 1);
        }
        .sidebar-link    { color: #a7f3d0; border-radius: 8px; transition: all .2s; }
        .sidebar-link:hover  { background: rgba(255,255,255,.1); color: #fff; }
        .sidebar-link.active { background: #059669; color: #fff; box-shadow: 0 2px 8px rgba(5,150,105,.4); }

        /* Responsive sidebar alignment */
        @media (max-width: 1023px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            main { margin-left: 0 !important; }
        }

        /* ── Cards ── */
        .stat-card { border-radius: 16px; padding: 24px; position: relative; overflow: hidden; }
        .stat-card::before {
            content: '';
            position: absolute;
            top: -20px; right: -20px;
            width: 100px; height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
        }

        /* ── Badge transaksi ── */
        .badge-masuk  { background: #d1fae5; color: #065f46; }
        .badge-keluar { background: #fee2e2; color: #991b1b; }

        /* ── Input focus ── */
        .input-field {
            width: 100%;
            border: 1px solid #e7e5e4;
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 14px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .input-field:focus {
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5,150,105,.15);
        }

        /* ── Tombol utama ── */
        .btn-primary {
            background: #059669;
            color: #fff;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            transition: background .2s, transform .1s;
        }
        .btn-primary:hover  { background: #047857; }
        .btn-primary:active { transform: scale(.98); }

        .btn-secondary {
            background: #fff;
            color: #57534e;
            border: 1px solid #e7e5e4;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            transition: background .2s;
        }
        .btn-secondary:hover { background: #f5f5f4; }

        /* ── Tabel ── */
        .tabel-row:hover { background: #f0fdf4; }
        .tabel-row td    { padding: 14px 20px; font-size: 14px; }

        /* ── Animasi fade-in ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp .4s ease forwards; }
        .fade-up:nth-child(2) { animation-delay: .05s; }
        .fade-up:nth-child(3) { animation-delay: .10s; }
        .fade-up:nth-child(4) { animation-delay: .15s; }
    </style>
</head>
<body class="bg-stone-50 min-h-screen flex overflow-x-hidden">

{{-- Backdrop Overlay untuk Mobile --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-stone-900/40 backdrop-blur-sm z-20 hidden transition-opacity duration-300"></div>

{{-- ══════════════════════ SIDEBAR ══════════════════════ --}}
<aside id="sidebar" class="sidebar w-64 fixed h-full flex flex-col z-30 shadow-2xl lg:shadow-none">

    {{-- Logo --}}
    <div class="px-6 py-6 border-b border-emerald-700 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-emerald-500 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">✝</div>
            <div>
                <p class="text-white font-bold text-sm leading-tight">TEGIF-GKS</p>
                <p class="text-emerald-300 text-xs">Bendahara</p>
            </div>
        </div>
        {{-- Close button mobile only --}}
        <button id="close-sidebar" class="text-emerald-200 hover:text-white lg:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">
        <p class="text-emerald-500 text-xs font-semibold uppercase tracking-widest px-3 mb-2">Menu</p>

        <a href="{{ route('bendahara.dashboard') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-medium {{ request()->routeIs('bendahara.dashboard') ? 'active' : '' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('bendahara.keuangan.index') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-medium {{ request()->routeIs('bendahara.keuangan*') ? 'active' : '' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Kas & Keuangan
        </a>

        <a href="{{ route('bendahara.laporan.index') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-medium {{ request()->routeIs('bendahara.laporan*') ? 'active' : '' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Laporan PDF
        </a>

        <div class="border-t border-emerald-700 my-3"></div>
        <p class="text-emerald-500 text-xs font-semibold uppercase tracking-widest px-3 mb-2">Lainnya</p>

        @if(in_array(Auth::user()->role, ['admin']))
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
            </svg>
            Panel Admin
        </a>
        @endif
    </nav>

    {{-- User info + Logout --}}
    <div class="px-4 py-4 border-t border-emerald-700">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
            </div>
            <div>
                <p class="text-white text-xs font-semibold leading-tight">{{ Auth::user()->nama }}</p>
                <p class="text-emerald-400 text-xs capitalize">{{ Auth::user()->role }}</p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-2 text-xs text-emerald-300 hover:text-red-300 transition px-1 py-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>

{{-- ══════════════════════ MAIN AREA ══════════════════════ --}}
<main class="lg:ml-64 flex-1 min-h-screen flex flex-col w-full min-w-0">

    {{-- Topbar --}}
    <div class="bg-white border-b border-stone-200 px-4 sm:px-8 py-4 flex items-center justify-between sticky top-0 z-10">
        <div class="flex items-center gap-3">
            {{-- Hamburger Menu Trigger --}}
            <button id="menu-toggle" class="p-1 text-stone-600 hover:text-stone-900 lg:hidden focus:outline-none focus:bg-stone-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div>
                <h1 class="text-sm sm:text-base font-semibold text-stone-800">@yield('title')</h1>
                <p class="text-[10px] sm:text-xs text-stone-400">
                    {{ now()->isoFormat('dddd, D MMMM YYYY') }}
                </p>
            </div>
        </div>
        <span class="bg-emerald-100 text-emerald-700 text-[11px] sm:text-xs font-semibold px-2.5 sm:px-3 py-1 rounded-full">
            Bendahara
        </span>
    </div>

    {{-- Konten Utama --}}
    <div class="p-4 sm:p-8 flex-1">
        @if(session('success'))
        <div class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm fade-up">
            <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @yield('content')
    </div>
</main>

{{-- Script untuk Mobile Menu Toggle --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menu-toggle');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleMenu() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
        }

        if(menuToggle) menuToggle.addEventListener('click', toggleMenu);
        if(closeSidebar) closeSidebar.addEventListener('click', toggleMenu);
        if(overlay) overlay.addEventListener('click', toggleMenu);
    });
</script>
</body>
</html>
