@extends('layouts.admin')
@section('title','Dashboard')
@section('content')

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Lato:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
/* ── Tokens ─────────────────────────────── */
:root {
    --forest:      #1a3d2b;
    --forest-mid:  #224d36;
    --forest-lite: #2d6645;
    --forest-pale: #e8f5ee;
    --gold:        #c9a84c;
    --gold-light:  #e8c97a;
    --gold-pale:   #fdf7e8;
    --cream:       #f8f6f1;
    --ink:         #1e2d27;
    --muted:       #6b7f74;
}

/* ── Layout shell ────────────────────────── */
.db-wrap {
    font-family: 'Lato', sans-serif;
    background: var(--cream);
    min-height: 100vh;
    color: var(--ink);
}

/* ── Header ──────────────────────────────── */
.db-header {
    background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 60%, #1e5c3a 100%);
    border-radius: 16px;
    padding: 1.75rem 2rem;
    margin-bottom: 1.75rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(26,61,43,.28);
}
.db-header::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: rgba(201,168,76,.10);
}
.db-header::after {
    content: '';
    position: absolute;
    bottom: -40px; left: 30%;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
}
.db-header-inner { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
.db-title { font-family: 'Cinzel', serif; font-size: 1.6rem; font-weight: 700; color: #fff; letter-spacing: .04em; }
.db-sub   { font-size: .85rem; color: rgba(255,255,255,.65); margin-top: .2rem; }
.db-sub span { color: var(--gold-light); font-weight: 700; }
.db-badge {
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(201,168,76,.35);
    border-radius: 50px;
    padding: .45rem 1.1rem;
    color: var(--gold-light);
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .08em;
    backdrop-filter: blur(6px);
    white-space: nowrap;
}

/* ── Stat cards ───────────────────────────── */
.stat-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.75rem;
}
@media(min-width: 640px)  { .stat-grid { grid-template-columns: repeat(4, 1fr); } }
@media(min-width: 1024px) { .stat-grid { grid-template-columns: repeat(8, 1fr); } }

.stat-card {
    background: #fff;
    border-radius: 14px;
    padding: 1.1rem 1rem 1rem;
    border: 1.5px solid #e8ede9;
    box-shadow: 0 2px 12px rgba(26,61,43,.06);
    cursor: pointer;
    transition: transform .2s, box-shadow .2s, border-color .2s;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    gap: .55rem;
    position: relative;
    overflow: hidden;
    animation: cardIn .45s ease both;
}
.stat-card:nth-child(1) { animation-delay: .05s; }
.stat-card:nth-child(2) { animation-delay: .10s; }
.stat-card:nth-child(3) { animation-delay: .15s; }
.stat-card:nth-child(4) { animation-delay: .20s; }
.stat-card:nth-child(5) { animation-delay: .25s; }
.stat-card:nth-child(6) { animation-delay: .30s; }
.stat-card:nth-child(7) { animation-delay: .35s; }
.stat-card:nth-child(8) { animation-delay: .40s; }
@keyframes cardIn {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

.stat-card::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    border-radius: 0 0 14px 14px;
    background: var(--c-accent, #e8ede9);
    transform: scaleX(0);
    transition: transform .25s;
}
.stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(26,61,43,.14); border-color: var(--c-accent, #ccc); }
.stat-card:hover::before { transform: scaleX(1); }

.stat-icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    background: var(--c-bg, #f0f0f0);
    color: var(--c-accent, #888);
    flex-shrink: 0;
    transition: background .2s, color .2s;
}
.stat-card:hover .stat-icon { background: var(--c-accent, #888); color: #fff; }

.stat-label { font-size: .65rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--muted); }
.stat-value { font-family: 'Cinzel', serif; font-size: 1.7rem; font-weight: 700; color: var(--c-accent, var(--ink)); line-height: 1; }
.stat-tag   { font-size: .6rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em;
              background: var(--c-bg, #f0f0f0); color: var(--c-accent, #888); border-radius: 5px; padding: .2rem .5rem; display: inline-block; }

/* ── Charts section ────────────────────────── */
.chart-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.25rem;
    margin-bottom: 1.75rem;
}
@media(min-width: 768px) { .chart-grid { grid-template-columns: 2fr 1fr; } }

.chart-card {
    background: #fff;
    border-radius: 16px;
    padding: 1.5rem;
    border: 1.5px solid #e8ede9;
    box-shadow: 0 2px 12px rgba(26,61,43,.06);
    animation: cardIn .5s .45s ease both;
}
.chart-card-full {
    background: #fff;
    border-radius: 16px;
    padding: 1.5rem;
    border: 1.5px solid #e8ede9;
    box-shadow: 0 2px 12px rgba(26,61,43,.06);
    animation: cardIn .5s .5s ease both;
}
.chart-title {
    font-family: 'Cinzel', serif;
    font-size: .9rem;
    font-weight: 700;
    color: var(--forest);
    margin-bottom: 1.1rem;
    display: flex;
    align-items: center;
    gap: .5rem;
}
.chart-title::before {
    content: '';
    display: inline-block;
    width: 4px; height: 16px;
    background: var(--gold);
    border-radius: 2px;
}
.chart-wrap { position: relative; width: 100%; }

/* ── Activity / quick-info row ────────────────── */
.info-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.25rem;
}
@media(min-width: 768px) { .info-grid { grid-template-columns: 1fr 1fr; } }

.info-card {
    background: #fff;
    border-radius: 16px;
    padding: 1.5rem;
    border: 1.5px solid #e8ede9;
    box-shadow: 0 2px 12px rgba(26,61,43,.06);
    animation: cardIn .5s .55s ease both;
}

.progress-row { display: flex; flex-direction: column; gap: .75rem; }
.progress-item { display: flex; flex-direction: column; gap: .3rem; }
.progress-meta { display: flex; justify-content: space-between; font-size: .78rem; font-weight: 600; color: var(--ink); }
.progress-meta span:last-child { color: var(--muted); font-weight: 400; }
.progress-bar { height: 7px; background: #eef2ef; border-radius: 50px; overflow: hidden; }
.progress-fill { height: 100%; border-radius: 50px; transition: width 1.2s cubic-bezier(.4,0,.2,1); }

.activity-list { display: flex; flex-direction: column; gap: .7rem; }
.activity-item {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    padding: .6rem .8rem;
    border-radius: 10px;
    background: var(--cream);
    transition: background .2s;
}
.activity-item:hover { background: var(--forest-pale); }
.activity-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 4px;
}
.activity-text { font-size: .8rem; line-height: 1.45; color: var(--ink); }
.activity-text strong { font-weight: 700; }
.activity-time { font-size: .7rem; color: var(--muted); margin-top: .15rem; }

/* ── Footer strip ────────────────────────── */
.db-footer {
    margin-top: 1.75rem;
    padding: 1rem 1.5rem;
    background: linear-gradient(90deg, var(--forest) 0%, var(--forest-lite) 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: .5rem;
    animation: cardIn .5s .6s ease both;
}
.db-footer-text { font-size: .75rem; color: rgba(255,255,255,.55); letter-spacing: .04em; }
.db-footer-text strong { color: var(--gold-light); }
</style>

<div class="db-wrap">

{{-- ── HEADER ──────────────────────────────── --}}
<div class="db-header">
    <div class="db-header-inner">
        <div>
            <div class="db-title">⛪ Dashboard GKS Kanatang</div>
            <div class="db-sub">Selamat datang kembali, <span>{{ Auth::user()->nama }}</span></div>
        </div>
        <div class="db-badge" id="liveClock">—</div>
    </div>
</div>

{{-- ── STAT CARDS ───────────────────────────── --}}
<div class="stat-grid">

    <a href="{{ route('admin.jemaat.index') }}" class="stat-card" style="--c-accent:#16a34a;--c-bg:#dcfce7;">
        <div class="stat-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div class="stat-label">Total Jemaat</div>
        <div class="stat-value" id="val-jemaat">—</div>
        <div class="stat-tag">Anggota</div>
    </a>

    <a href="{{ route('admin.pelayan.index') }}" class="stat-card" style="--c-accent:#0284c7;--c-bg:#e0f2fe;">
        <div class="stat-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <div class="stat-label">Pelayan Aktif</div>
        <div class="stat-value" id="val-pelayan">—</div>
        <div class="stat-tag">Aktif</div>
    </a>

    <a href="{{ route('admin.jadwal-ibadah.index') }}" class="stat-card" style="--c-accent:#7c3aed;--c-bg:#ede9fe;">
        <div class="stat-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-label">Jadwal Ibadah</div>
        <div class="stat-value" id="val-ibadah">—</div>
        <div class="stat-tag">Agenda</div>
    </a>

    <a href="{{ route('admin.jadwal-pa.index') }}" class="stat-card" style="--c-accent:#ea580c;--c-bg:#ffedd5;">
        <div class="stat-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        </div>
        <div class="stat-label">Jadwal PA</div>
        <div class="stat-value" id="val-pa">—</div>
        <div class="stat-tag">Alkitab</div>
    </a>

    <a href="{{ route('admin.jadwal-kesasi.index') }}" class="stat-card" style="--c-accent:#0d9488;--c-bg:#ccfbf1;">
        <div class="stat-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
        </div>
        <div class="stat-label">Jadwal Kesasi</div>
        <div class="stat-value" id="val-kesasi">—</div>
        <div class="stat-tag">Katekisasi</div>
    </a>

    <a href="{{ route('admin.wartamimbar.index') }}" class="stat-card" style="--c-accent:#db2777;--c-bg:#fce7f3;">
        <div class="stat-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
        </div>
        <div class="stat-label">Warta Mimbar</div>
        <div class="stat-value" id="val-warta">—</div>
        <div class="stat-tag">Informasi</div>
    </a>

    <a href="{{ route('admin.asset.index') }}" class="stat-card" style="--c-accent:#d97706;--c-bg:#fef3c7;">
        <div class="stat-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h10a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
        <div class="stat-label">Asset Gereja</div>
        <div class="stat-value" id="val-asset">—</div>
        <div class="stat-tag">Logistik</div>
    </a>

    <a href="{{ route('admin.wilayah.index') }}" class="stat-card" style="--c-accent:#475569;--c-bg:#f1f5f9;">
        <div class="stat-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div class="stat-label">Wilayah</div>
        <div class="stat-value" id="val-wilayah">—</div>
        <div class="stat-tag">Lokasi</div>
    </a>

</div>

{{-- ── CHARTS ROW ───────────────────────────── --}}
<div class="chart-grid">

    {{-- Bar chart: overview semua data --}}
    <div class="chart-card">
        <div class="chart-title">Ringkasan Data Gereja</div>
        <div class="chart-wrap" style="height:230px;">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    {{-- Doughnut: komposisi --}}
    <div class="chart-card">
        <div class="chart-title">Komposisi Pelayanan</div>
        <div class="chart-wrap" style="height:230px;">
            <canvas id="doughnutChart"></canvas>
        </div>
    </div>

</div>

{{-- ── Line chart: tren mingguan (dummy) --}}
<div class="chart-card-full" style="margin-bottom:1.25rem;">
    <div class="chart-title">Tren Kehadiran Ibadah (6 Minggu Terakhir)</div>
    <div class="chart-wrap" style="height:180px;">
        <canvas id="lineChart"></canvas>
    </div>
</div>

{{-- ── INFO ROW ─────────────────────────────── --}}
<div class="info-grid">

    {{-- Progress distribusi --}}
    <div class="info-card">
        <div class="chart-title">Distribusi Layanan</div>
        <div class="progress-row" id="progressRows">
            {{-- filled by JS --}}
        </div>
    </div>

    {{-- Recent activity --}}
    <div class="info-card">
        <div class="chart-title">Aktivitas Terkini</div>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-dot" style="background:#16a34a;"></div>
                <div>
                    <div class="activity-text"><strong>Jemaat baru</strong> terdaftar di wilayah Kanatang Barat</div>
                    <div class="activity-time">Hari ini, 08.30</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot" style="background:#7c3aed;"></div>
                <div>
                    <div class="activity-text"><strong>Jadwal Ibadah Minggu</strong> diperbarui untuk bulan ini</div>
                    <div class="activity-time">Kemarin, 14.15</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot" style="background:#0284c7;"></div>
                <div>
                    <div class="activity-text"><strong>Pelayan baru</strong> ditambahkan ke tim musik</div>
                    <div class="activity-time">2 hari lalu</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot" style="background:#ea580c;"></div>
                <div>
                    <div class="activity-text"><strong>Jadwal PA</strong> untuk kelompok dewasa dijadwalkan ulang</div>
                    <div class="activity-time">3 hari lalu</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot" style="background:#c9a84c;"></div>
                <div>
                    <div class="activity-text"><strong>Warta Mimbar</strong> edisi baru telah dipublikasikan</div>
                    <div class="activity-time">Minggu lalu</div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ── FOOTER ───────────────────────────────── --}}
<div class="db-footer">
    <div class="db-footer-text">GKS Kanatang &mdash; Sistem Informasi Pengurus Gereja</div>
    <div class="db-footer-text">Login sebagai <strong>{{ Auth::user()->nama }}</strong></div>
</div>

</div>{{-- end db-wrap --}}

<script>
(function () {
    /* ── live clock ──────────────────────────── */
    function tick() {
        const d = new Date();
        const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        document.getElementById('liveClock').textContent =
            days[d.getDay()] + ', ' +
            d.toLocaleDateString('id-ID',{day:'2-digit',month:'long',year:'numeric'}) + ' · ' +
            d.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'});
    }
    tick(); setInterval(tick, 1000);

    /* ── stat data from Blade ─────────────────── */
    const stats = {
        jemaat:  {{ \App\Models\Jemaat::count() }},
        pelayan: {{ \App\Models\Pelayan::where('aktif',true)->count() }},
        ibadah:  {{ \App\Models\JadwalIbadahMinggu::count() }},
        pa:      {{ \App\Models\JadwalPelayananPa::count() }},
        kesasi:  {{ \App\Models\JadwalKesasi::count() }},
        warta:   {{ \App\Models\Wartamimbar::count() }},
        asset:   {{ \App\Models\AssetGereja::count() }},
        wilayah: {{ \App\Models\Wilayah::count() }},
    };

    /* ── animate counters ─────────────────────── */
    function animCount(id, target) {
        const el = document.getElementById(id);
        if (!el) return;
        let cur = 0;
        const step = Math.max(1, Math.ceil(target / 40));
        const t = setInterval(() => {
            cur = Math.min(cur + step, target);
            el.textContent = cur;
            if (cur >= target) clearInterval(t);
        }, 30);
    }
    animCount('val-jemaat',  stats.jemaat);
    animCount('val-pelayan', stats.pelayan);
    animCount('val-ibadah',  stats.ibadah);
    animCount('val-pa',      stats.pa);
    animCount('val-kesasi',  stats.kesasi);
    animCount('val-warta',   stats.warta);
    animCount('val-asset',   stats.asset);
    animCount('val-wilayah', stats.wilayah);

    /* ── shared chart options ─────────────────── */
    const FOREST = '#1a3d2b', GOLD = '#c9a84c';
    Chart.defaults.font.family = 'Lato';
    Chart.defaults.color = '#6b7f74';

    /* ── BAR CHART ────────────────────────────── */
    const labels  = ['Jemaat','Pelayan','Ibadah','PA','Kesasi','Warta','Asset','Wilayah'];
    const values  = [stats.jemaat, stats.pelayan, stats.ibadah, stats.pa, stats.kesasi, stats.warta, stats.asset, stats.wilayah];
    const colors  = ['#16a34a','#0284c7','#7c3aed','#ea580c','#0d9488','#db2777','#d97706','#475569'];

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah',
                data: values,
                backgroundColor: colors.map(c => c + '22'),
                borderColor: colors,
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: {
                backgroundColor: FOREST,
                titleColor: GOLD,
                bodyColor: '#fff',
                cornerRadius: 8,
                padding: 10,
            }},
            scales: {
                x: { grid: { display: false }, border: { display: false } },
                y: { grid: { color: '#e8ede9' }, border: { display: false }, ticks: { stepSize: 1 } }
            }
        }
    });

    /* ── DOUGHNUT CHART ───────────────────────── */
    const dTotal = stats.ibadah + stats.pa + stats.kesasi + stats.warta;
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Ibadah','PA','Kesasi','Warta'],
            datasets: [{
                data: dTotal > 0
                    ? [stats.ibadah, stats.pa, stats.kesasi, stats.warta]
                    : [1, 1, 1, 1],
                backgroundColor: ['#7c3aed','#ea580c','#0d9488','#db2777'],
                borderColor: '#fff',
                borderWidth: 3,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 14, boxWidth: 12, font: { size: 11 } } },
                tooltip: {
                    backgroundColor: FOREST,
                    titleColor: GOLD,
                    bodyColor: '#fff',
                    cornerRadius: 8,
                }
            }
        }
    });

    /* ── LINE CHART (dummy trend) ─────────────── */
    const weekLabels = ['5 Mgg Lalu','4 Mgg Lalu','3 Mgg Lalu','2 Mgg Lalu','Mgg Lalu','Minggu Ini'];
    const baseJemaat = Math.max(20, stats.jemaat);
    const trendData  = weekLabels.map((_, i) =>
        Math.round(baseJemaat * (.55 + .08 * i + (Math.random() * .1 - .05)))
    );

    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: weekLabels,
            datasets: [{
                label: 'Kehadiran',
                data: trendData,
                borderColor: FOREST,
                backgroundColor: 'rgba(26,61,43,.08)',
                borderWidth: 2.5,
                tension: .4,
                fill: true,
                pointBackgroundColor: GOLD,
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: FOREST,
                    titleColor: GOLD,
                    bodyColor: '#fff',
                    cornerRadius: 8,
                    padding: 10,
                }
            },
            scales: {
                x: { grid: { display: false }, border: { display: false } },
                y: { grid: { color: '#e8ede9' }, border: { display: false } }
            }
        }
    });

    /* ── PROGRESS BARS ────────────────────────── */
    const items = [
        { label: 'Jemaat',    val: stats.jemaat,  max: Math.max(stats.jemaat, 200),  color: '#16a34a' },
        { label: 'Pelayan',   val: stats.pelayan, max: Math.max(stats.pelayan, 50),   color: '#0284c7' },
        { label: 'Jadwal PA', val: stats.pa,      max: Math.max(stats.pa, 30),        color: '#ea580c' },
        { label: 'Kesasi',    val: stats.kesasi,  max: Math.max(stats.kesasi, 30),    color: '#0d9488' },
        { label: 'Asset',     val: stats.asset,   max: Math.max(stats.asset, 50),     color: '#d97706' },
    ];
    const container = document.getElementById('progressRows');
    items.forEach(item => {
        const pct = Math.round((item.val / item.max) * 100);
        container.innerHTML += `
        <div class="progress-item">
            <div class="progress-meta">
                <span>${item.label}</span>
                <span>${item.val} &nbsp;(${pct}%)</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width:0%;background:${item.color};"
                     data-target="${pct}"></div>
            </div>
        </div>`;
    });

    /* animate progress bars after paint */
    requestAnimationFrame(() => {
        setTimeout(() => {
            document.querySelectorAll('.progress-fill').forEach(el => {
                el.style.width = el.dataset.target + '%';
            });
        }, 300);
    });

})();
</script>

@endsection