@extends('layouts.admin')
@section('title', 'Tambah Asset')

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
        <a href="{{ route('admin.asset.index') }}" 
           class="group inline-flex items-center gap-2 text-sm text-emerald-700 font-bold hover:text-emerald-900 transition-colors">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Asset
        </a>
        <h2 class="text-3xl font-extrabold text-slate-800 mt-2 tracking-tight">Tambah Asset</h2>
        <p class="text-slate-500 text-sm mt-1">Inputkan data aset gereja baru ke dalam sistem.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>

        <form action="{{ route('admin.asset.store') }}" method="POST" id="formTambahAsset" onsubmit="return handleSimpan(event, this)" class="p-6 md:p-10 space-y-6">
            @csrf

            <!-- Nama Asset -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Asset <span class="text-red-500">*</span></label>
                <input type="text" name="nama_aset" value="{{ old('nama_aset') }}" required placeholder="Contoh: Kursi Lipat"
                       class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jumlah -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" required
                           class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                </div>

                <!-- Kondisi -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kondisi <span class="text-red-500">*</span></label>
                    <select name="kondisi" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                        <option value="layak" {{ old('kondisi', 'layak') == 'layak' ? 'selected' : '' }}>Layak</option>
                        <option value="kurang_layak" {{ old('kondisi') == 'kurang_layak' ? 'selected' : '' }}>Kurang Layak</option>
                        <option value="tidak_layak" {{ old('kondisi') == 'tidak_layak' ? 'selected' : '' }}>Tidak Layak</option>
                    </select>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3">
                <button type="submit" 
                        class="w-full sm:w-auto bg-[#143222] text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide
                               hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 
                               shadow-lg shadow-emerald-900/20 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Simpan Asset
                </button>
                <a href="{{ route('admin.asset.index') }}" 
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
            text: 'Data aset baru sedang diproses.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => { Swal.showLoading(); }
        });
        setTimeout(() => { form.submit(); }, 800);
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#143222',
            timer: 2500
        });
    @endif
</script>

@endsection