@extends('layouts.admin')
@section('title','Jadwal Kunjungan')
@section('content')

{{-- ═══════════════════════════════════════════════════════════
     JADWAL KUNJUNGAN — GKS Kanatang Admin Panel
     Tema: Deep Sage / Emerald — konsisten dengan panel admin lainnya
     ═══════════════════════════════════════════════════════════ --}}

<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap');

:root {
    --sage-50:  #f2f7f4;
    --sage-100: #e0ede6;
    --sage-200: #c2dace;
    --sage-300: #96c0a7;
    --sage-400: #659f83;
    --sage-500: #3f7f5f;
    --sage-600: #2d6349;
    --sage-700: #1f4d34;
    --sage-800: #163728;
    --sage-900: #0e2419;
    --sage-950: #091510;
    --gold-400: #c9a84c;
    --gold-500: #b8913a;
    --gold-100: #fdf6e3;
}

.admin-kunjungan * { font-family: 'Source Sans 3', sans-serif; }

/* Page Header */
.admin-kunjungan .page-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    padding-bottom: 1.25rem;
    border-bottom: 2px solid var(--sage-100);
    gap: 1rem;
}
.admin-kunjungan .page-header-left {
    display: flex;
    align-items: center;
    gap: 0.875rem;
}
.admin-kunjungan .page-icon {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, var(--sage-700), var(--sage-500));
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(31,77,52,0.25);
}
.admin-kunjungan .page-icon svg { color: white; }
.admin-kunjungan .page-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--sage-900);
    line-height: 1.2;
    letter-spacing: -0.01em;
}
.admin-kunjungan .page-subtitle {
    font-size: 0.8rem;
    color: #78716c;
    margin-top: 1px;
    font-weight: 500;
}

/* Tombol Tambah */
.admin-kunjungan .btn-primary {
    background: linear-gradient(135deg, var(--sage-800), var(--sage-600));
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.8125rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    box-shadow: 0 2px 8px rgba(31,77,52,0.3);
    transition: all 0.2s ease;
    white-space: nowrap;
    border: 1px solid var(--sage-700);
}
.admin-kunjungan .btn-primary:hover {
    background: linear-gradient(135deg, var(--sage-900), var(--sage-700));
    box-shadow: 0 4px 12px rgba(31,77,52,0.4);
    transform: translateY(-1px);
}

/* Alert */
.admin-kunjungan .alert-success {
    margin-bottom: 1rem;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #15803d;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border-left: 4px solid #16a34a;
}
.admin-kunjungan .alert-error {
    margin-bottom: 1rem;
    background: #fff1f2;
    border: 1px solid #fecdd3;
    color: #be123c;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border-left: 4px solid #e11d48;
}

/* Table Container */
.admin-kunjungan .table-card {
    background: white;
    border-radius: 12px;
    border: 1px solid var(--sage-100);
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(14,36,25,0.07), 0 4px 16px rgba(14,36,25,0.04);
}
.admin-kunjungan table {
    width: 100%;
    font-size: 0.875rem;
    border-collapse: collapse;
}
.admin-kunjungan thead tr {
    background: linear-gradient(to right, var(--sage-50), #fafaf9);
    border-bottom: 2px solid var(--sage-100);
}
.admin-kunjungan thead th {
    text-align: left;
    padding: 0.75rem 1.25rem;
    font-weight: 700;
    font-size: 0.75rem;
    color: var(--sage-700);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    white-space: nowrap;
}
.admin-kunjungan thead th.center { text-align: center; }

.admin-kunjungan tbody tr {
    border-bottom: 1px solid var(--sage-50);
    transition: background 0.15s ease;
}
.admin-kunjungan tbody tr:last-child { border-bottom: none; }
.admin-kunjungan tbody tr:hover { background: var(--sage-50); }

.admin-kunjungan td {
    padding: 0.875rem 1.25rem;
    vertical-align: middle;
    color: #44403c;
}

/* Waktu cell */
.admin-kunjungan .td-waktu {
    font-family: 'Source Sans 3', sans-serif;
}
.admin-kunjungan .waktu-date {
    font-weight: 700;
    color: var(--sage-800);
    font-size: 0.875rem;
    display: block;
}
.admin-kunjungan .waktu-time {
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--sage-500);
    margin-top: 1px;
    display: block;
}

/* Tujuan cell */
.admin-kunjungan .td-tujuan {
    color: #57534e;
    font-size: 0.875rem;
    max-width: 280px;
}

/* Wilayah badge */
.admin-kunjungan .badge-wilayah {
    display: inline-flex;
    align-items: center;
    background: var(--sage-100);
    color: var(--sage-800);
    padding: 0.2rem 0.6rem;
    border-radius: 5px;
    font-size: 0.7rem;
    font-weight: 700;
    border: 1px solid var(--sage-200);
    letter-spacing: 0.02em;
    text-transform: uppercase;
    white-space: nowrap;
}

/* Nomor urut */
.admin-kunjungan .td-num {
    color: #a8a29e;
    font-size: 0.8125rem;
    font-weight: 600;
    width: 48px;
}

/* Aksi tombol */
.admin-kunjungan .td-aksi { text-align: center; }
.admin-kunjungan .aksi-group {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.375rem;
}
.admin-kunjungan .btn-edit {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
    padding: 0.25rem 0.625rem;
    border-radius: 5px;
    font-size: 0.75rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.15s;
    display: inline-block;
}
.admin-kunjungan .btn-edit:hover {
    background: #dbeafe;
    box-shadow: 0 1px 4px rgba(29,78,216,0.2);
}
.admin-kunjungan .btn-hapus {
    background: #fff1f2;
    color: #be123c;
    border: 1px solid #fecdd3;
    padding: 0.25rem 0.625rem;
    border-radius: 5px;
    font-size: 0.75rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s;
}
.admin-kunjungan .btn-hapus:hover {
    background: #ffe4e6;
    box-shadow: 0 1px 4px rgba(190,18,60,0.2);
}
.admin-kunjungan form.inline-form {
    display: inline-flex;
    margin: 0;
}

/* Empty state */
.admin-kunjungan .empty-state {
    text-align: center;
    padding: 3.5rem 1rem;
    color: #a8a29e;
}
.admin-kunjungan .empty-icon {
    font-size: 2.5rem;
    margin-bottom: 0.625rem;
    display: block;
}
.admin-kunjungan .empty-text {
    font-size: 0.9rem;
    font-weight: 500;
}

/* Pagination wrapper */
.admin-kunjungan .pagination-wrap {
    margin-top: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-kunjungan thead th:nth-child(1),
    .admin-kunjungan td:nth-child(1) { display: none; }
    .admin-kunjungan .td-tujuan { max-width: 160px; }
    .admin-kunjungan .page-title { font-size: 1.3rem; }
}
</style>

<div class="admin-kunjungan">

    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div>
                <div class="page-title">Jadwal Kunjungan</div>
                <div class="page-subtitle">Daftar kunjungan pastoral jemaat GKS Kanatang</div>
            </div>
        </div>
        <a href="{{ route('admin.kunjungan.create') }}" class="btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Kunjungan
        </a>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="alert-success">
        <span>✅</span> {{ session('success') }}
    </div>
    @endif

    {{-- Alert error --}}
    @if(session('error'))
    <div class="alert-error">
        <span>⚠️</span> {{ session('error') }}
    </div>
    @endif

    {{-- Tabel --}}
    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Waktu</th>
                    <th>Tujuan Kunjungan</th>
                    <th>Wilayah</th>
                    <th class="center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kunjungan as $i => $k)
                <tr>
                    <td class="td-num">{{ $kunjungan->firstItem() + $i }}</td>
                    <td class="td-waktu">
                        <span class="waktu-date">{{ $k->waktu_kunjungan->format('d M Y') }}</span>
                        <span class="waktu-time">{{ $k->waktu_kunjungan->format('H:i') }} WITA</span>
                    </td>
                    <td class="td-tujuan">{{ Str::limit($k->tujuan, 70) }}</td>
                    <td>
                        <span class="badge-wilayah">{{ $k->wilayah->nama_wilayah }}</span>
                    </td>
                    <td class="td-aksi">
                        <div class="aksi-group">
                            <a href="{{ route('admin.kunjungan.edit', $k) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('admin.kunjungan.destroy', $k) }}" method="POST"
                                  class="inline-form"
                                  onsubmit="return confirm('Hapus jadwal kunjungan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-hapus">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <span class="empty-icon">🏠</span>
                            <p class="empty-text">Belum ada jadwal kunjungan yang diinput.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">{{ $kunjungan->links() }}</div>

</div>

@endsection