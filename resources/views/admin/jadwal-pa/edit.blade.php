@extends('layouts.admin')
@section('title', 'Edit Jadwal PA')

@section('content')

{{-- Custom CSS --}}
<style>
    .input-modern { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .input-modern:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        background-color: #ffffff;
    }
</style>

<div class="max-w-3xl mx-auto pb-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.jadwal-pa.index') }}" class="group inline-flex items-center gap-2 text-sm text-emerald-700 font-bold hover:text-emerald-900 transition-colors">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Jadwal
        </a>
        <h2 class="text-3xl font-extrabold text-stone-800 mt-2 tracking-tight">Edit Jadwal PA</h2>
        <p class="text-stone-500 text-sm mt-1">Lakukan perubahan data untuk jadwal Pendalaman Alkitab.</p>
    </div>

    <!-- Card Formulir -->
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="bg-[#143222] text-white px-6 py-4 flex items-center justify-between">
            <h3 class="text-sm font-extrabold uppercase tracking-wider text-amber-400">Formulir Pembaruan</h3>
            <div class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></div>
        </div>

        <form action="{{ route('admin.jadwal-pa.update', $jadwal->id_pelayanan_pa ?? $jadwal->id) }}" method="POST" id="formEditPA" onsubmit="return handleUpdate(event, this)" class="p-6 md:p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Waktu -->
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-2">Waktu & Jam Pelaksanaan</label>
                    <input type="datetime-local" name="waktu" 
                           value="{{ old('waktu', $jadwal->waktu ? \Carbon\Carbon::parse($jadwal->waktu)->format('Y-m-d\TH:i') : '') }}"
                           class="input-modern w-full px-4 py-3 border border-stone-200 rounded-xl text-sm focus:outline-none" required>
                </div>

                <!-- Penerima PA -->
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-2">Nama Penerima PA</label>
                    <input type="text" name="nama_penerima_pa" 
                           value="{{ old('nama_penerima_pa', $jadwal->nama_penerima_pa) }}"
                           placeholder="Contoh: Bpk. Yohanis"
                           class="input-modern w-full px-4 py-3 border border-stone-200 rounded-xl text-sm focus:outline-none" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pelayan -->
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-2">Pelayan Utama</label>
                    <select name="id_pelayan" class="input-modern w-full px-4 py-3 border border-stone-200 rounded-xl text-sm focus:outline-none cursor-pointer" required>
                        @foreach($pelayan as $p)
                            <option value="{{ $p->id_pelayan }}" {{ old('id_pelayan', $jadwal->id_pelayan) == $p->id_pelayan ? 'selected' : '' }}>
                                {{ $p->nama_pelayan }} ({{ $p->jenis }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pendamping -->
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-2">Pelayan Pendamping</label>
                    <select name="id_pendamping" class="input-modern w-full px-4 py-3 border border-stone-200 rounded-xl text-sm focus:outline-none cursor-pointer" required>
                        @foreach($pelayan as $p)
                            <option value="{{ $p->id_pelayan }}" {{ old('id_pendamping', $jadwal->id_pendamping) == $p->id_pelayan ? 'selected' : '' }}>
                                {{ $p->nama_pelayan }} ({{ $p->jenis }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Wilayah -->
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-2">Wilayah</label>
                    <select name="id_wilayah" class="input-modern w-full px-4 py-3 border border-stone-200 rounded-xl text-sm focus:outline-none cursor-pointer" required>
                        @foreach($wilayah as $w)
                            <option value="{{ $w->id_wilayah }}" {{ old('id_wilayah', $jadwal->id_wilayah) == $w->id_wilayah ? 'selected' : '' }}>
                                {{ $w->nama_wilayah }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Ayat -->
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-2">Ayat / Nats Alkitab</label>
                    <input type="text" name="ayat" value="{{ old('ayat', $jadwal->ayat) }}" placeholder="Contoh: Yohanes 3:16"
                           class="input-modern w-full px-4 py-3 border border-stone-200 rounded-xl text-sm focus:outline-none" required>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-6 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('admin.jadwal-pa.index') }}" 
                   class="px-6 py-3 rounded-xl text-sm font-bold text-stone-600 hover:bg-stone-100 transition">Batal</a>
                <button type="submit" 
                        class="bg-[#143222] hover:bg-emerald-900 text-white px-8 py-3 rounded-xl text-sm font-bold transition shadow-lg shadow-emerald-900/20 hover:-translate-y-0.5">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function handleUpdate(event, form) {
        event.preventDefault();
        Swal.fire({
            title: 'Memperbarui...',
            text: 'Data sedang disimpan ke sistem.',
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