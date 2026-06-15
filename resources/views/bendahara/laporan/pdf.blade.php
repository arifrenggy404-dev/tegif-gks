<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Keuangan {{ $bulanLabel }} {{ $tahun }}</title>
<style>
    * { margin:0; padding:0; box-sizing:border-box; }

    body {
        font-family: 'DejaVu Sans', sans-serif;
        font-size: 11px;
        color: #1e293b;
        line-height: 1.5;
        background: #fff;
    }

    /* ── KOP ── */
    .kop {
        background: #0c1a3a;
        color: #fff;
        padding: 24px 32px;
        margin-bottom: 0;
    }

    .kop-inner {
        display: table;
        width: 100%;
    }

    .kop-left  { display: table-cell; vertical-align: middle; width: 60%; }
    .kop-right { display: table-cell; vertical-align: middle; text-align: right; }

    .kop-nama {
        font-size: 16px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 3px;
    }

    .kop-sub {
        font-size: 10px;
        color: #8ba3cc;
    }

    .kop-badge {
        font-size: 11px;
        font-weight: 700;
        color: #fff;
        border: 1px solid rgba(255,255,255,.3);
        padding: 5px 14px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 4px;
    }

    .kop-periode {
        font-size: 10px;
        color: #8ba3cc;
    }

    .kop-divider {
        border: none;
        border-top: 1px solid rgba(255,255,255,.15);
        margin: 16px 0 12px;
    }

    .kop-alamat {
        font-size: 10px;
        color: #8ba3cc;
    }

    /* ── RINGKASAN ── */
    .ringkasan {
        display: table;
        width: 100%;
        border-bottom: 2px solid #e2e8f0;
    }

    .ringkasan-item {
        display: table-cell;
        padding: 14px 20px;
        border-right: 1px solid #f1f5f9;
        width: 25%;
    }

    .ringkasan-item:last-child { border-right: none; }

    .rl { font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: #64748b; margin-bottom: 5px; }
    .rv { font-size: 14px; font-weight: 700; }
    .rv-green  { color: #059669; }
    .rv-red    { color: #dc2626; }
    .rv-blue   { color: #1d4ed8; }
    .rv-dark   { color: #0f172a; }

    /* ── SECTION TITLE ── */
    .sec-title {
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: #64748b;
        padding: 16px 24px 10px;
        border-bottom: 1.5px solid #e2e8f0;
    }

    /* ── TABEL ── */
    .tbl-wrap { padding: 0 24px 20px; }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead tr { background: #f8fafc; }

    th {
        text-align: left;
        padding: 9px 10px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #64748b;
        border-bottom: 1.5px solid #e2e8f0;
    }

    th.text-right { text-align: right; }

    td {
        padding: 9px 10px;
        font-size: 11px;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    td.text-right { text-align: right; }

    tr.row-even { background: #fafafa; }

    .badge-masuk {
        background: #d1fae5;
        color: #065f46;
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 9.5px;
        font-weight: 700;
    }

    .badge-keluar {
        background: #fee2e2;
        color: #991b1b;
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 9.5px;
        font-weight: 700;
    }

    .td-num   { color: #94a3b8; font-size: 10px; }
    .td-date  { font-weight: 600; color: #0f172a; white-space: nowrap; }
    .td-green { font-weight: 700; color: #059669; text-align: right; }
    .td-red   { font-weight: 700; color: #dc2626; text-align: right; }

    /* Footer tabel */
    .tbl-footer-masuk   td { background: #f0fdf4; font-weight: 700; color: #059669; border-top: 1.5px solid #d1fae5; }
    .tbl-footer-keluar  td { background: #fef2f2; font-weight: 700; color: #dc2626; }
    .tbl-footer-saldo   td { background: #eff6ff; font-weight: 700; color: #1d4ed8; font-size: 12px; border-top: 2px solid #bfdbfe; }

    /* ── TANDA TANGAN ── */
    .ttd-section {
        display: table;
        width: 100%;
        padding: 20px 24px 24px;
        border-top: 1.5px solid #f1f5f9;
        margin-top: 8px;
    }

    .ttd-left  { display: table-cell; width: 50%; vertical-align: bottom; }
    .ttd-right { display: table-cell; width: 50%; text-align: center; vertical-align: bottom; }

    .ttd-info  { font-size: 9.5px; color: #94a3b8; line-height: 1.6; }

    .ttd-box {
        display: inline-block;
        min-width: 160px;
        padding-top: 50px;
        border-top: 1.5px solid #334155;
        font-size: 11px;
        font-weight: 700;
        color: #0f172a;
    }

    .ttd-kota {
        font-size: 11px;
        color: #64748b;
        margin-bottom: 48px;
    }

    /* Page break */
    .page-break { page-break-after: always; }
</style>
</head>
<body>

{{-- ══ KOP SURAT ══ --}}
<div class="kop">
    <div class="kop-inner">
        <div class="kop-left">
            <div class="kop-nama">TEGIF — GKS Kanatang</div>
            <div class="kop-sub">Gereja Kristen Sumba &nbsp;·&nbsp; GKS Kanatang</div>
        </div>
        <div class="kop-right">
            <div class="kop-badge">LAPORAN KEUANGAN</div><br>
            <div class="kop-periode">Periode: {{ $bulanLabel }} {{ $tahun }}</div>
        </div>
    </div>
    <hr class="kop-divider">
    <div class="kop-alamat">Kanatang, Kabupaten Sumba Timur, Nusa Tenggara Timur</div>
</div>

{{-- ══ RINGKASAN ══ --}}
<div class="ringkasan">
    <div class="ringkasan-item">
        <div class="rl">Saldo Awal</div>
        <div class="rv rv-dark">Rp {{ number_format($saldoAwal,0,',','.') }}</div>
    </div>
    <div class="ringkasan-item" style="background:#f0fdf4">
        <div class="rl" style="color:#15803d">Total Pemasukan</div>
        <div class="rv rv-green">Rp {{ number_format($totalPemasukan,0,',','.') }}</div>
    </div>
    <div class="ringkasan-item" style="background:#fef2f2">
        <div class="rl" style="color:#b91c1c">Total Pengeluaran</div>
        <div class="rv rv-red">Rp {{ number_format($totalPengeluaran,0,',','.') }}</div>
    </div>
    <div class="ringkasan-item" style="background:#eff6ff">
        <div class="rl" style="color:#1d4ed8">Saldo Akhir</div>
        <div class="rv {{ $saldoAkhir >= 0 ? 'rv-blue' : 'rv-red' }}">
            Rp {{ number_format($saldoAkhir,0,',','.') }}
        </div>
    </div>
</div>

{{-- ══ RINCIAN TRANSAKSI ══ --}}
<div class="sec-title">Rincian Transaksi — {{ $bulanLabel }} {{ $tahun }}</div>

<div class="tbl-wrap">
    <table>
        <thead>
            <tr>
                <th style="width:30px">#</th>
                <th style="width:80px">Tanggal</th>
                <th>Keterangan</th>
                <th style="width:80px">Jenis</th>
                <th class="text-right" style="width:130px">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($transaksi as $t)
            <tr class="{{ $loop->even ? 'row-even' : '' }}">
                <td class="td-num">{{ $no++ }}</td>
                <td class="td-date">{{ $t->tanggal_transaksi->format('d M Y') }}</td>
                <td>{{ $t->keterangan ?? '-' }}</td>
                <td>
                    @if($t->jenis_transaksi === 'pemasukan')
                    <span class="badge-masuk">Pemasukan</span>
                    @else
                    <span class="badge-keluar">Pengeluaran</span>
                    @endif
                </td>
                <td class="{{ $t->jenis_transaksi === 'pemasukan' ? 'td-green' : 'td-red' }}">
                    {{ $t->jenis_transaksi === 'pemasukan' ? '+' : '-' }}
                    Rp {{ number_format($t->total,0,',','.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:24px;color:#94a3b8">
                    Tidak ada transaksi pada periode ini.
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="tbl-footer-masuk">
                <td colspan="4" style="padding:10px">Total Pemasukan</td>
                <td class="text-right" style="padding:10px">Rp {{ number_format($totalPemasukan,0,',','.') }}</td>
            </tr>
            <tr class="tbl-footer-keluar">
                <td colspan="4" style="padding:10px">Total Pengeluaran</td>
                <td class="text-right" style="padding:10px">Rp {{ number_format($totalPengeluaran,0,',','.') }}</td>
            </tr>
            <tr class="tbl-footer-saldo">
                <td colspan="4" style="padding:12px">SALDO AKHIR</td>
                <td class="text-right" style="padding:12px">Rp {{ number_format($saldoAkhir,0,',','.') }}</td>
            </tr>
        </tfoot>
    </table>
</div>

{{-- ══ TANDA TANGAN ══ --}}
<div class="ttd-section">
    <div class="ttd-left">
        <div class="ttd-info">
            Dicetak pada: {{ $dicetak }}<br>
            Dicetak oleh: {{ $dicetakOleh }}<br>
            Sistem Informasi TEGIF — GKS Kanatang
        </div>
    </div>
    <div class="ttd-right">
        <div class="ttd-kota">Kanatang, {{ now()->isoFormat('D MMMM YYYY') }}</div>
        <div class="ttd-box">Bendahara Gereja</div>
    </div>
</div>

</body>
</html>