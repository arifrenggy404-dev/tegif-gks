@extends('layouts.admin')
@section('title', 'Tambah Jadwal Ibadah')

@section('content')

{{-- Custom CSS Khusus Form --}}
<style>
    .form-card-shadow { box-shadow: 0 10px 40px -10px rgba(20, 50, 34, 0.08); }
    .input-modern { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .input-modern:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        background-color: #ffffff;
        transform: translateY(-1px);
    }
    .section-title {
        font-size: 0.75rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #047857;
        margin-bottom: 1rem;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 0.5rem;
    }
</style>

<div class="max-w-3xl mx-auto pb-10">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('admin.jadwal-ibadah.index') }}"
               class="group inline-flex items-center gap-2.5 px-4 py-2 mb-4 bg-white border border-slate-200 rounded-full shadow-sm hover:shadow-md hover:border-emerald-300 transition-all duration-300 w-fit cursor-pointer">
                <div class="bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-600 p-1.5 rounded-full transition-colors duration-300">
                    <svg class="w-3.5 h-3.5 transform transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-700 tracking-wide pr-1">Kembali</span>
            </a>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Tambah Jadwal Ibadah</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Mengatur jadwal pelayanan untuk ibadah mingguan.</p>
        </div>
    </div>

    {{-- Error validasi --}}
    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm">
            <p class="font-bold mb-1">Terdapat kesalahan pada form:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden form-card-shadow relative">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>

        <form action="{{ route('admin.jadwal-ibadah.store') }}" method="POST" id="formTambahJadwal" onsubmit="return handleSimpanJadwal(event, this)" class="p-6 md:p-10 space-y-8">
            @csrf

            {{-- 1. Pelayanan --}}
            <div>
                <h3 class="section-title">Pelayanan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Pelayan <span class="text-red-500">*</span></label>
                        <select name="id_pelayan" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                            <option value="">-- Pilih Pelayan --</option>
                            @foreach($pelayan as $p)
                                <option value="{{ $p->id_pelayan }}" {{ old('id_pelayan') == $p->id_pelayan ? 'selected' : '' }}>{{ $p->nama_pelayan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Pendamping <span class="text-red-500">*</span></label>
                        <select name="id_pendamping" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                            <option value="">-- Pilih Pendamping --</option>
                            @foreach($pelayan as $p)
                                <option value="{{ $p->id_pelayan }}" {{ old('id_pendamping') == $p->id_pelayan ? 'selected' : '' }}>{{ $p->nama_pelayan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- 2. Tema & Bacaan --}}
            <div>
                <h3 class="section-title">Tema &amp; Bacaan</h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tema Ibadah</label>
                        <input type="text" name="tema" value="{{ old('tema') }}" placeholder="Contoh: Kasih yang Tak Bersyarat"
                            class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Ayat Bacaan <span class="text-red-500">*</span></label>
                        <input type="text" name="ayat_bacaan" value="{{ old('ayat_bacaan') }}" required placeholder="Contoh: Yohanes 3:16-17"
                            class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nats Pembimbing</label>
                            <input type="text" name="nats_pembimbing" value="{{ old('nats_pembimbing') }}" placeholder="Contoh: Mazmur 23:1"
                                class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Ayat Firman</label>
                            <input type="text" name="ayat_firman" value="{{ old('ayat_firman') }}" placeholder="Contoh: Roma 8:28"
                                class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Unsur Liturgi --}}
            <div>
                <h3 class="section-title">Unsur Liturgi</h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Berita Anugerah</label>
                        <textarea name="berita_anugerah" rows="3" placeholder="Tuliskan teks berita anugerah..."
                            class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none">{{ old('berita_anugerah') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Petunjuk Hidup Baru</label>
                        <textarea name="petunjuk_hidup_baru" rows="3" placeholder="Tuliskan teks petunjuk hidup baru..."
                            class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none">{{ old('petunjuk_hidup_baru') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- 4. Waktu & Lokasi --}}
            <div>
                <h3 class="section-title">Waktu &amp; Lokasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Waktu Ibadah <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="waktu" value="{{ old('waktu') }}" required
                            class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi Ibadah <span class="text-red-500">*</span></label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" required placeholder="Contoh: Gedung Gereja Utama"
                            class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none">
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3">
                <button type="submit"
                    class="w-full sm:w-auto bg-[#143222] text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide
                           hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300
                           shadow-lg shadow-emerald-900/20 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Simpan Jadwal
                </button>
                <a href="{{ route('admin.jadwal-ibadah.index') }}"
                   class="w-full sm:w-auto bg-white border border-slate-300 text-slate-600 px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide
                          hover:bg-slate-50 hover:border-slate-400 hover:text-slate-800 transition-all duration-300 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function handleSimpanJadwal(event, form) {
        event.preventDefault();
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Data jadwal sedang diproses.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => { Swal.showLoading(); }
        });
        setTimeout(() => { form.submit(); }, 800);
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#143222',
                timer: 2500,
                timerProgressBar: true
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        @endif
    });
</script>

@endsection
