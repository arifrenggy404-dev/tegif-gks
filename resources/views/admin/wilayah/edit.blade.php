@extends('layouts.admin')
@section('title', 'Edit Wilayah')

@section('content')

{{-- Custom CSS untuk Estetika --}}
<style>
    .input-modern {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .input-modern:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        background-color: #ffffff;
    }
</style>

<div class="max-w-3xl mx-auto pb-10">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('admin.wilayah.index') }}"
               class="group inline-flex items-center gap-2.5 px-4 py-2 mb-4 bg-white border border-slate-200 rounded-full shadow-sm hover:shadow-md hover:border-emerald-300 transition-all duration-300 w-fit cursor-pointer">
                <div class="bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-600 p-1.5 rounded-full transition-colors duration-300">
                    <svg class="w-3.5 h-3.5 transform transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-700 tracking-wide pr-1">Kembali</span>
            </a>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Edit Wilayah</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Memperbarui data <strong class="text-emerald-700">{{ $wilayah->nama_wilayah }}</strong>.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden shadow-sm relative">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>

        <form action="{{ route('admin.wilayah.update', $wilayah) }}" method="POST" id="formEditWilayah" onsubmit="return handleUpdate(event, this)" class="p-6 md:p-10 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Wilayah <span class="text-red-500">*</span></label>
                <input type="text" name="nama_wilayah" value="{{ old('nama_wilayah', $wilayah->nama_wilayah) }}" required
                    class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                @error('nama_wilayah')
                    <p class="text-red-500 text-xs font-bold mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="pt-4 flex flex-col sm:flex-row items-center gap-3">
                <button type="submit"
                    class="w-full sm:w-auto bg-[#143222] text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide
                           hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 
                           shadow-lg shadow-emerald-900/20 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    Simpan Perubahan
                </button>
                
                <a href="{{ route('admin.wilayah.index') }}"
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
            text: 'Data wilayah sedang disimpan.',
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