@extends('layouts.bendahara')
@section('title', 'Dashboard Keuangan')
@section('content')

{{-- Akses Cepat (Quick Access) --}}
<div class="bg-white border border-stone-200 rounded-2xl p-4 sm:p-5 shadow-sm fade-up mb-6">
    <div class="flex items-center gap-2 font-bold text-stone-800 border-b border-stone-100 pb-3 mb-4">
        <svg class="w-5 h-5 text-amber-500 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs sm:text-sm tracking-wide uppercase text-stone-700">Akses Cepat</span>
    </div>
    {{-- Flex Wrap & Grid adjustment for smaller screens --}}
    <div class="grid grid-cols-1 sm:flex sm:flex-wrap items-center gap-3">
        <a href="{{ route('bendahara.keuangan.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-semibold transition shadow-md shadow-emerald-600/10 w-full sm:w-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Transaksi
        </a>
        <a href="{{ route('bendahara.laporan.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white hover:bg-stone-100 text-stone-700 border border-stone-200 rounded-xl text-xs font-semibold transition shadow-sm w-full sm:w-auto">
            <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 1.258a1.791 1.791 0 01-1.753 2.112H8.104a1.791 1.791 0 01-1.753-2.112L6.58 18m11.08 0H6.58m12.131-4.171A1.791 1.791 0 0019.5 12.22V8.79C19.5 5.593 16.907 3 13.71 3H10.29C7.093 3 4.5 5.593 4.5 8.79v3.43c0 .815.546 1.516 1.332 1.617"/>
            </svg>
            Cetak Laporan PDF
        </a>
        <a href="{{ route('bendahara.laporan.stream') }}?bulan={{ now()->format('Y-m') }}"
           target="_blank"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white hover:bg-stone-100 text-stone-700 border border-stone-200 rounded-xl text-xs font-semibold transition shadow-sm w-full sm:w-auto">
            <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zM14.25 15h.008v.008H14.25V15zm0 2.25h.008v.008H14.25v-.008zM16.5 15h.008v.008H16.5V15zm0 2.25h.008v.008H16.5v-.008z"/>
            </svg>
            PDF Bulan Ini
        </a>
    </div>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

    {{-- Pemasukan --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 to-emerald-500 text-white rounded-2xl p-5 shadow-sm fade-up">
        <p class="text-emerald-100 text-[10px] font-bold uppercase tracking-wider mb-1">Pemasukan Bulan Ini</p>
        <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
        <p class="text-emerald-200/80 text-xs mt-2 font-medium">Total dana kas masuk</p>
        <svg class="absolute top-3 right-3 w-16 h-16 text-white/10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.281m5.94 2.28l-2.28 5.941"/>
        </svg>
    </div>

    {{-- Pengeluaran --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-red-600 to-red-500 text-white rounded-2xl p-5 shadow-sm fade-up">
        <p class="text-red-100 text-[10px] font-bold uppercase tracking-wider mb-1">Pengeluaran Bulan Ini</p>
        <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
        <p class="text-red-200/80 text-xs mt-2 font-medium">Total dana kas keluar</p>
        <svg class="absolute top-3 right-3 w-16 h-16 text-white/10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6L9 12.75l4.306-4.307a11.95 11.95 0 015.814 5.519l2.74 1.22m0 0l-5.94 2.281m5.94-2.28l-2.28-5.941"/>
        </svg>
    </div>

    {{-- Saldo Berjalan --}}
    @php $saldoPositif = $saldo >= 0; @endphp
    <div class="relative overflow-hidden bg-gradient-to-br {{ $saldoPositif ? 'from-blue-600 to-blue-500' : 'from-amber-600 to-amber-500' }} text-white rounded-2xl p-5 shadow-sm fade-up sm:col-span-2 lg:col-span-1">
        <p class="text-blue-100 text-[10px] font-bold uppercase tracking-wider mb-1">Saldo Berjalan</p>
        <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight">Rp {{ number_format(abs($saldo), 0, ',', '.') }}</p>
        <p class="text-blue-100/80 text-xs mt-2 font-medium">
            {{ $saldoPositif ? 'Status saldo aman ✓' : 'Peringatan: Saldo defisit' }}
        </p>
        @if($saldoPositif)
            <svg class="absolute top-3 right-3 w-16 h-16 text-white/10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        @else
            <svg class="absolute top-3 right-3 w-16 h-16 text-white/10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
            </svg>
        @endif
    </div>

</div>

{{-- Main Layout Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

    {{-- Grafik Arus Kas --}}
    <div class="lg:col-span-3 bg-white rounded-2xl border border-stone-200 p-4 sm:p-5 shadow-sm flex flex-col justify-between min-h-[340px] sm:min-h-[380px] fade-up min-w-0">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="font-bold text-stone-800 text-xs sm:text-sm md:text-base">Arus Kas 6 Bulan</h3>
                <p class="text-stone-400 text-[11px] mt-0.5 font-medium">Perbandingan Pemasukan vs Pengeluaran</p>
            </div>
            <a href="{{ route('bendahara.keuangan.index') }}" class="text-emerald-600 hover:text-emerald-700 text-xs font-bold transition flex items-center gap-1">
                Lihat semua
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>
        {{-- Konten Grafik dengan pembungkus Chart agar tidak overflow lebar --}}
        <div class="relative w-full flex-1 min-h-[220px]">
            <canvas id="grafikKeuangan"></canvas>
        </div>
    </div>

    {{-- Transaksi Terbaru --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-stone-200 p-4 sm:p-5 shadow-sm flex flex-col justify-between min-h-[340px] sm:min-h-[380px] fade-up">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-stone-800 text-xs sm:text-sm md:text-base">Transaksi Terbaru</h3>
            <a href="{{ route('bendahara.keuangan.create') }}" class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white text-[11px] px-3 py-1.5 rounded-xl font-bold transition shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Tambah
            </a>
        </div>

        <div class="space-y-3 flex-1 overflow-y-auto pr-1 max-h-[280px]">
            @forelse($transaksiTerbaru as $t)
            <div class="flex items-start gap-3 pb-3 border-b border-stone-100 last:border-0 last:pb-0">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0 transition-colors {{ $t->jenis_transaksi === 'pemasukan' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                    @if($t->jenis_transaksi === 'pemasukan')
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"/>
                        </svg>
                    @else
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3"/>
                        </svg>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm font-semibold text-stone-700 truncate">
                        {{ $t->keterangan ?? 'Tidak ada keterangan' }}
                    </p>
                    <p class="text-[10px] text-stone-400 mt-0.5 font-medium">
                        {{ $t->tanggal_transaksi->format('d M Y') }}
                    </p>
                </div>
                <p class="text-xs sm:text-sm font-bold shrink-0 whitespace-nowrap tracking-tight mt-0.5 {{ $t->jenis_transaksi === 'pemasukan' ? 'text-emerald-600' : 'text-red-500' }}">
                    {{ $t->jenis_transaksi === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($t->total, 0, ',', '.') }}
                </p>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <svg class="w-10 h-10 text-stone-200 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z"/>
                </svg>
                <p class="text-stone-400 text-xs font-medium">Belum ada transaksi.</p>
            </div>
            @endforelse
        </div>
    </div>

</div>

{{-- Chart.js Enhancement Script --}}
<script>
const labels   = @json($grafik->pluck('bulan'));
const masuk    = @json($grafik->pluck('pemasukan'));
const keluar   = @json($grafik->pluck('pengeluaran'));

new Chart(document.getElementById('grafikKeuangan'), {
    type: 'bar',
    data: {
        labels,
        datasets: [
            {
                label: 'Pemasukan',
                data: masuk,
                backgroundColor: '#10b981',
                hoverBackgroundColor: '#059669',
                borderRadius: 6,
                borderSkipped: false,
                barPercentage: 0.7,
                categoryPercentage: 0.7
            },
            {
                label: 'Pengeluaran',
                data: keluar,
                backgroundColor: '#f43f5e',
                hoverBackgroundColor: '#e11d48',
                borderRadius: 6,
                borderSkipped: false,
                barPercentage: 0.7,
                categoryPercentage: 0.7
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            mode: 'index',
            intersect: false,
        },
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 10,
                    boxHeight: 10,
                    usePointStyle: true,
                    pointStyle: 'circle',
                    padding: 15,
                    font: {
                        family: "Plus Jakarta Sans, system-ui, sans-serif",
                        size: 11,
                        weight: '600'
                    },
                    color: '#57534e'
                }
            },
            tooltip: {
                backgroundColor: '#1c1917',
                padding: 10,
                titleFont: { family: "Plus Jakarta Sans, sans-serif", size: 12, weight: '700' },
                bodyFont: { family: "Plus Jakarta Sans, sans-serif", size: 11, weight: '500' },
                borderRadius: 10,
                boxPadding: 4,
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';
                        if (label) label += ': ';
                        if (context.parsed.y !== null) {
                            label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.parsed.y);
                        }
                        return label;
                    }
                }
            }
        },
        scales: {
            y: {
                ticks: {
                    color: '#a8a29e',
                    font: { family: "Inter, sans-serif", size: 9 },
                    // Menyingkat Rp pada layar handphone agar hemat space
                    callback: v => window.innerWidth < 640 ? (v / 1000000) + 'M' : 'Rp ' + new Intl.NumberFormat('id-ID').format(v)
                },
                grid: { color: '#f5f5f4', tickBorderDash: [4, 4] }
            },
            x: {
                ticks: {
                    color: '#78716c',
                    font: { family: "Plus Jakarta Sans, sans-serif", size: 10, weight: '600' }
                },
                grid: { display: false }
            }
        }
    }
});
</script>
@endsection
