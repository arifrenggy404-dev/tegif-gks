<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEGIF-GKS Kanatang | @yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lato:ital,wght@0,300;0,400;0,700;1,300italic&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --forest: #0e2a1a;
            --pine:   #143222;
            --fern:   #1f4d34;
            --leaf:   #2a6645;
            --gold:   #c9a84c;
            --gold-lt:#e8c87a;
            --cream:  #f5f0e8;
        }

        * { box-sizing: border-box; }
        html { font-family: 'Lato', sans-serif; }
        body { background: var(--cream); color: #1a1a1a; }

        /* ── TOP BAR ─────────────────────────────── */
        .top-bar {
            background: var(--forest);
            border-bottom: 1px solid rgba(201,168,76,.2);
            padding: 7px 0;
            font-size: 11px;
            color: rgba(255,255,255,.55);
            font-weight: 600;
            letter-spacing: .03em;
        }
        .top-bar-inner {
            max-width: 1100px; margin: 0 auto;
            padding: 0 24px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .top-bar .loc { display: flex; align-items: center; gap: 6px; }
        .top-bar .right { display: flex; gap: 20px; align-items: center; }
        .top-bar a { color: rgba(255,255,255,.55); text-decoration: none; transition: color .2s; }
        .top-bar a:hover { color: var(--gold-lt); }
        .top-bar .gold-text { color: var(--gold); font-weight: 700; }

        /* ── NAVBAR ──────────────────────────────── */
        #main-navbar {
            position: sticky; top: 0; z-index: 50;
            background: rgba(14,42,26,.97);
            border-bottom: 1px solid rgba(201,168,76,.18);
            transition: box-shadow .3s, background .3s;
            backdrop-filter: blur(10px);
        }
        #main-navbar.scrolled {
            box-shadow: 0 4px 30px rgba(0,0,0,.35);
            background: rgba(10,30,18,.98);
        }

        .nav-inner {
            max-width: 1100px; margin: 0 auto;
            padding: 0 24px;
            height: 62px;
            display: flex; align-items: center; justify-content: space-between;
        }

        /* Logo */
        .nav-logo {
            display: flex; align-items: center; gap: 12px;
            text-decoration: none;
        }
        .nav-logo-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--fern), var(--forest));
            border: 1px solid rgba(201,168,76,.45);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,.3);
            transition: transform .2s, box-shadow .2s;
            flex-shrink: 0;
        }
        .nav-logo:hover .nav-logo-icon { transform: scale(1.06); box-shadow: 0 4px 18px rgba(201,168,76,.25); }
        .nav-logo-text { line-height: 1; }
        .nav-logo-main {
            font-family: 'Cinzel', serif;
            font-size: 1.05rem; font-weight: 700;
            color: #fff; display: block;
            letter-spacing: .04em;
        }
        .nav-logo-sub {
            font-size: 9px; font-weight: 700;
            color: var(--gold); text-transform: uppercase;
            letter-spacing: .16em; display: block; margin-top: 2px;
        }

        /* Nav links */
        .nav-links {
            display: flex; align-items: center; gap: 2px;
        }
        .nav-link {
            font-size: 13px; font-weight: 700;
            color: rgba(255,255,255,.7);
            padding: 8px 13px; border-radius: 9px;
            text-decoration: none;
            transition: color .2s, background .2s;
            position: relative;
            letter-spacing: .02em;
        }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,.1); }
        .nav-link.active { color: var(--gold-lt); background: rgba(201,168,76,.12); }
        .nav-link.active::after {
            content: '';
            position: absolute; bottom: 4px; left: 50%; transform: translateX(-50%);
            width: 18px; height: 2px; background: var(--gold);
            border-radius: 2px;
        }

        .nav-divider {
            width: 1px; height: 20px;
            background: rgba(255,255,255,.15);
            margin: 0 8px;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--gold) 0%, #a8873a 100%);
            color: var(--forest);
            font-size: 12px; font-weight: 800;
            padding: 9px 20px; border-radius: 10px;
            text-decoration: none;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 2px 12px rgba(201,168,76,.35);
            letter-spacing: .03em;
        }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 4px 18px rgba(201,168,76,.45); color: var(--forest); }

        /* Hamburger */
        .hamburger-btn {
            display: none;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 10px;
            padding: 8px; cursor: pointer;
            color: #fff;
            transition: background .2s;
        }
        .hamburger-btn:hover { background: rgba(255,255,255,.15); }

        /* Mobile menu */
        #mobile-menu {
            display: none;
            background: var(--forest);
            border-top: 1px solid rgba(201,168,76,.2);
            padding: 12px 20px 16px;
        }
        #mobile-menu.open { display: block; }
        .mob-link {
            display: block; padding: 11px 14px;
            font-size: 13px; font-weight: 700;
            color: rgba(255,255,255,.75);
            border-radius: 10px; text-decoration: none;
            transition: background .2s, color .2s;
            letter-spacing: .02em;
        }
        .mob-link:hover, .mob-link.active {
            background: rgba(255,255,255,.1); color: var(--gold-lt);
        }
        .mob-login {
            display: block; width: 100%; text-align: center;
            background: linear-gradient(135deg, var(--gold), #a8873a);
            color: var(--forest); font-weight: 800; font-size: 13px;
            padding: 13px; border-radius: 12px; text-decoration: none;
            margin-top: 12px;
            box-shadow: 0 2px 12px rgba(201,168,76,.3);
        }

        @media(max-width: 768px) {
            .hamburger-btn { display: flex; align-items: center; justify-content: center; }
            .nav-links { display: none; }
        }

        /* ── FOOTER ──────────────────────────────── */
        footer {
            background: var(--forest);
            border-top: 1px solid rgba(201,168,76,.2);
            margin-top: 64px;
        }
        .footer-inner {
            max-width: 1100px; margin: 0 auto;
            padding: 56px 24px 40px;
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr;
            gap: 40px;
        }
        @media(max-width: 768px){
            .footer-inner { grid-template-columns: 1fr; gap: 32px; }
        }

        .footer-logo-row {
            display: flex; align-items: center; gap: 10px; margin-bottom: 14px;
        }
        .footer-logo-icon {
            width: 40px; height: 40px;
            background: rgba(201,168,76,.15);
            border: 1px solid rgba(201,168,76,.3);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
        }
        .footer-brand {
            font-family: 'Cinzel', serif;
            font-size: 1rem; font-weight: 700;
            color: #fff;
        }
        .footer-tagline {
            font-size: 12px; color: rgba(255,255,255,.45);
            line-height: 1.75; font-weight: 300;
        }

        .footer-col-title {
            font-size: 10px; font-weight: 800;
            text-transform: uppercase; letter-spacing: .14em;
            color: var(--gold); margin-bottom: 16px;
        }
        .footer-links { display: flex; flex-direction: column; gap: 10px; }
        .footer-links a {
            font-size: 12px; color: rgba(255,255,255,.55);
            text-decoration: none; font-weight: 600;
            transition: color .2s;
            display: flex; align-items: center; gap: 7px;
        }
        .footer-links a:hover { color: var(--gold-lt); }
        .footer-links a::before {
            content: '→';
            font-size: 10px; color: var(--gold);
            opacity: .6;
        }

        .footer-contact-item {
            display: flex; align-items: flex-start; gap: 9px;
            font-size: 12px; color: rgba(255,255,255,.5);
            line-height: 1.6; font-weight: 400;
            margin-bottom: 10px;
        }
        .footer-contact-icon {
            color: var(--gold); font-size: 13px; flex-shrink: 0; margin-top: 1px;
        }

        .footer-divider {
            max-width: 1100px; margin: 0 auto;
            border: none; height: 1px;
            background: rgba(255,255,255,.08);
        }
        .footer-bottom {
            max-width: 1100px; margin: 0 auto;
            padding: 18px 24px;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 8px;
        }
        .footer-bottom p {
            font-size: 11px; color: rgba(255,255,255,.3);
            font-weight: 600; letter-spacing: .03em;
        }
        .footer-bottom .gold-badge {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 10px; font-weight: 700;
            color: var(--gold); letter-spacing: .06em;
            text-transform: uppercase;
            border: 1px solid rgba(201,168,76,.25);
            padding: 4px 12px; border-radius: 20px;
            background: rgba(201,168,76,.07);
        }

        /* ── SCROLL-TO-TOP ───────────────────────── */
        #scroll-top {
            position: fixed; bottom: 28px; right: 24px; z-index: 99;
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--fern), var(--forest));
            border: 1px solid rgba(201,168,76,.4);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            opacity: 0; transform: translateY(10px);
            transition: opacity .3s, transform .3s, box-shadow .2s;
            box-shadow: 0 4px 18px rgba(0,0,0,.25);
        }
        #scroll-top.show { opacity: 1; transform: translateY(0); }
        #scroll-top:hover { box-shadow: 0 6px 22px rgba(201,168,76,.3); }
        #scroll-top svg { color: var(--gold); }
    </style>
</head>
<body>

<!-- ░░░ TOP BAR ░░░ -->
<div class="top-bar hidden sm:block">
    <div class="top-bar-inner">
        <div class="loc">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/></svg>
            Kec. Kanatang, Kabupaten Sumba Timur, Nusa Tenggara Timur
        </div>
        <div class="right">
            <a href="mailto:info@gkskanatang.or.id">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:inline;margin-right:4px"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 7 10-7"/></svg>
                info@gkskanatang.or.id
            </a>
            <span class="gold-text">✦ TEGIF — Sistem Informasi Terintegrasi</span>
        </div>
    </div>
</div>

<!-- ░░░ NAVBAR ░░░ -->
<nav id="main-navbar">
    <div class="nav-inner">

        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-icon">✝</div>
            <div class="nav-logo-text">
                <span class="nav-logo-main">TEGIF · GKS</span>
                <span class="nav-logo-sub">Jemaat Kanatang</span>
            </div>
        </a>

        <div class="nav-links">
            <a href="{{ route('home') }}"
               class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('public.jadwal-ibadah') }}"
               class="nav-link {{ request()->routeIs('public.jadwal-ibadah') ? 'active' : '' }}">Ibadah</a>
            <a href="{{ route('public.jadwal-pa') }}"
               class="nav-link {{ request()->routeIs('public.jadwal-pa') ? 'active' : '' }}">Pelayanan PA</a>
            <a href="{{ route('public.jadwal-kesasi') }}"
               class="nav-link {{ request()->routeIs('public.jadwal-kesasi') ? 'active' : '' }}">Kesasi</a>
            <a href="{{ route('public.wartamimbar') }}"
               class="nav-link {{ request()->routeIs('public.wartamimbar') ? 'active' : '' }}">Warta Mimbar</a>

            <div class="nav-divider"></div>

            <a href="{{ route('login') }}" class="btn-login">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:inline;margin-right:5px;vertical-align:-2px"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Masuk
            </a>
        </div>

        <button class="hamburger-btn" id="menu-toggle-btn" aria-label="Buka menu">
            <svg id="hamburger-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu">
        <a href="{{ route('home') }}"
           class="mob-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('public.jadwal-ibadah') }}"
           class="mob-link {{ request()->routeIs('public.jadwal-ibadah') ? 'active' : '' }}">Ibadah Minggu</a>
        <a href="{{ route('public.jadwal-pa') }}"
           class="mob-link {{ request()->routeIs('public.jadwal-pa') ? 'active' : '' }}">Pelayanan PA</a>
        <a href="{{ route('public.jadwal-kesasi') }}"
           class="mob-link {{ request()->routeIs('public.jadwal-kesasi') ? 'active' : '' }}">Katekisasi</a>
        <a href="{{ route('public.wartamimbar') }}"
           class="mob-link {{ request()->routeIs('public.wartamimbar') ? 'active' : '' }}">Warta Mimbar</a>
        <a href="{{ route('login') }}" class="mob-login">
            ✝ &nbsp;Masuk ke Sistem
        </a>
    </div>
</nav>

<!-- ░░░ MAIN CONTENT ░░░ -->
<main class="flex-grow w-full" style="display:flex;flex-direction:column;min-height:60vh">
    @yield('content')
</main>

<!-- ░░░ FOOTER ░░░ -->
<footer>
    <div class="footer-inner">

        <!-- Col 1: Brand -->
        <div>
            <div class="footer-logo-row">
                <div class="footer-logo-icon">✝</div>
                <span class="footer-brand">GKS Jemaat Kanatang</span>
            </div>
            <p class="footer-tagline">
                Platform <strong style="color:rgba(255,255,255,.65);font-weight:700">TEGIF</strong>
                (Sistem Informasi Jemaat Terintegrasi) menyajikan data jadwal ibadah minggu,
                penelaahan alkitab kategorial, katekisasi jemaat, dan warta mimbar secara
                akurat untuk mendukung pelayanan jemaat di Sumba Timur.
            </p>
            <!-- Decorative gold line -->
            <div style="margin-top:20px;height:2px;width:48px;background:linear-gradient(90deg,var(--gold),transparent);border-radius:2px"></div>
        </div>

        <!-- Col 2: Links -->
        <div>
            <p class="footer-col-title">Informasi Publik</p>
            <div class="footer-links">
                <a href="{{ route('public.jadwal-ibadah') }}">Jadwal Ibadah Minggu</a>
                <a href="{{ route('public.jadwal-pa') }}">Jadwal Pelayanan PA</a>
                <a href="{{ route('public.jadwal-kesasi') }}">Data Katekisasi</a>
                <a href="{{ route('public.wartamimbar') }}">Warta Mimbar</a>
                <a href="{{ route('login') }}">Login Pengurus</a>
            </div>
        </div>

        <!-- Col 3: Contact -->
        <div>
            <p class="footer-col-title">Hubungi Kami</p>
            <div class="footer-contact-item">
                <span class="footer-contact-icon">📍</span>
                <span>Kec. Kanatang, Kabupaten Sumba Timur, Nusa Tenggara Timur, Indonesia</span>
            </div>
            <div class="footer-contact-item">
                <span class="footer-contact-icon">📧</span>
                <span>sekretariat@gkskanatang.or.id</span>
            </div>
            <div class="footer-contact-item">
                <span class="footer-contact-icon">✝</span>
                <span style="color:rgba(255,255,255,.35);font-style:italic;font-size:11px">
                    "Sebab di mana dua atau tiga orang berkumpul dalam nama-Ku, di situ Aku ada di tengah-tengah mereka."<br>
                    <span style="color:var(--gold);font-weight:600">— Mat 18:20</span>
                </span>
            </div>
        </div>

    </div>

    <hr class="footer-divider">

    <div class="footer-bottom">
        <p>&copy; 2026 TEGIF GKS Kanatang — Sistem Informasi Layanan Terintegrasi. Hak Cipta Dilindungi.</p>
        <span class="gold-badge">✦ GKS Kanatang</span>
    </div>
</footer>

<!-- ░░░ SCROLL TO TOP ░░░ -->
<div id="scroll-top" title="Kembali ke atas">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="18 15 12 9 6 15"/>
    </svg>
</div>

<!-- ░░░ SCRIPTS ░░░ -->
<script>
    // Navbar scroll effect
    const navbar = document.getElementById('main-navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 20);
        document.getElementById('scroll-top').classList.toggle('show', window.scrollY > 300);
    });

    // Mobile menu toggle
    const menuBtn  = document.getElementById('menu-toggle-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
    });

    // Scroll to top
    document.getElementById('scroll-top').addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // SweetAlert flash messages
    document.addEventListener('DOMContentLoaded', () => {
        @if(session('success'))
        Swal.fire({
            icon: 'success', title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#143222',
            timer: 3000, timerProgressBar: true
        });
        @endif
        @if(session('error'))
        Swal.fire({
            icon: 'error', title: 'Gagal!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#d33'
        });
        @endif
        @if(session('warning'))
        Swal.fire({
            icon: 'warning', title: 'Peringatan!',
            text: "{{ session('warning') }}",
            confirmButtonColor: '#f59e0b'
        });
        @endif
    });
</script>

</body>
</html>