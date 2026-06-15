@extends('layouts.admin')
@section('title', 'Tambah Jadwal PA')

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
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('admin.jadwal-pa.index') }}"
               class="group inline-flex items-center gap-2.5 px-4 py-2 mb-4 bg-white border border-slate-200 rounded-full shadow-sm hover:shadow-md hover:border-emerald-300 transition-all duration-300 w-fit cursor-pointer">
                <div class="bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-600 p-1.5 rounded-full transition-colors duration-300">
                    <svg class="w-3.5 h-3.5 transform transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-700 tracking-wide pr-1">Kembali</span>
            </a>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Tambah Jadwal PA</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Buat jadwal Pendalaman Alkitab (PA) baru untuk jemaat.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden shadow-sm relative">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>

        <form action="{{ route('admin.jadwal-pa.store') }}" method="POST" id="formTambahPA" onsubmit="return handleSimpan(event, this)" class="p-6 md:p-10 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Wilayah --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Wilayah <span class="text-red-500">*</span></label>
                    <select name="id_wilayah" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                        <option value="">-- Pilih Wilayah --</option>
                        @foreach($wilayah as $w)
                            <option value="{{ $w->id_wilayah }}" {{ old('id_wilayah') == $w->id_wilayah ? 'selected' : '' }}>{{ $w->nama_wilayah }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Nama Penerima PA --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Penerima PA <span class="text-red-500">*</span></label>
                    <select name="nama_penerima_pa" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                        <option value="">-- Pilih Jemaat --</option>
                        @foreach($jemaat as $j)
                            <option value="{{ $j->nama_jemaat }}" {{ old('nama_penerima_pa') == $j->nama_jemaat ? 'selected' : '' }}>{{ $j->nama_jemaat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Pelayan --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Pelayan <span class="text-red-500">*</span></label>
                    <select name="id_pelayan" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                        <option value="">-- Pilih Pelayan --</option>
                        @foreach($pelayan as $p)
                            <option value="{{ $p->id_pelayan }}" {{ old('id_pelayan') == $p->id_pelayan ? 'selected' : '' }}>{{ $p->nama_pelayan }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Pendamping --}}
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Ayat Bacaan --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Ayat Bacaan <span class="text-red-500">*</span></label>
                    <input type="text" name="ayat" value="{{ old('ayat') }}" required placeholder="Contoh: Yohanes 3:16"
                        class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none">
                </div>

                {{-- Waktu --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Waktu PA <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="waktu" value="{{ old('waktu') }}" required
                        class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
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
                <a href="{{ route('admin.jadwal-pa.index') }}"
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
    function handleSimpan(event, form) {
        event.preventDefault();
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Data jadwal PA sedang diproses.',
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