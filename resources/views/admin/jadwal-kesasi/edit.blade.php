@extends('layouts.admin')
@section('title', 'Edit Jadwal Kesasi')

@section('content')

{{-- Custom CSS untuk Estetika --}}
<style>
    .input-modern { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .input-modern:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        background-color: #ffffff;
        transform: translateY(-1px);
    }
</style>

<div class="max-w-3xl mx-auto pb-10">
    <!-- Header & Navigasi -->
    <div class="mb-8">
        <a href="{{ route('admin.jadwal-kesasi.index') }}" 
           class="group inline-flex items-center gap-2 text-sm text-emerald-700 font-bold hover:text-emerald-900 transition-colors">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Jadwal
        </a>
        <h2 class="text-3xl font-extrabold text-slate-800 mt-2 tracking-tight">Edit Jadwal Kesasi</h2>
        <p class="text-slate-500 text-sm mt-1">Perbarui rincian sesi untuk jadwal kesasi.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>

        <form action="{{ route('admin.jadwal-kesasi.update', $jadwalKesasi) }}" method="POST" id="formEditKesasi" onsubmit="return handleUpdate(event, this)" class="p-6 md:p-10 space-y-6">
            @csrf 
            @method('PUT')

            <!-- Pengajar -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Pengajar <span class="text-red-500">*</span></label>
                <select name="id_pengajar" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                    <option value="">-- Pilih Pengajar --</option>
                    @foreach($pelayan as $p)
                        <option value="{{ $p->id_pelayan }}" {{ old('id_pengajar', $jadwalKesasi->id_pengajar) == $p->id_pelayan ? 'selected' : '' }}>
                            {{ $p->nama_pelayan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Materi -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Materi / Topik <span class="text-red-500">*</span></label>
                <input type="text" name="materi" value="{{ old('materi', $jadwalKesasi->materi) }}" required
                       class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
            </div>

            <!-- Waktu -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Waktu Pelaksanaan <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="waktu" value="{{ old('waktu', $jadwalKesasi->waktu->format('Y-m-d\TH:i')) }}" required
                       class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3">
                <button type="submit" 
                        class="w-full sm:w-auto bg-[#143222] text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide
                               hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 
                               shadow-lg shadow-emerald-900/20 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.jadwal-kesasi.index') }}" 
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
    function handleUpdate(event, form) {
        event.preventDefault();
        Swal.fire({
            title: 'Memperbarui...',
            text: 'Data jadwal sedang disimpan.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => { Swal.showLoading(); }
        });
        setTimeout(() => { form.submit(); }, 800);
    }
</script>

@endsection