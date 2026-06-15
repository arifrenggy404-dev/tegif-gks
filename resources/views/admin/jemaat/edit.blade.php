@extends('layouts.admin')
@section('title', 'Edit Jemaat')

@section('content')

{{-- Custom CSS Khusus Form --}}
<style>
    .form-card-shadow { box-shadow: 0 10px 40px -10px rgba(20, 50, 34, 0.08); }
    .input-modern { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .input-modern:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
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

<div class="max-w-4xl mx-auto pb-10">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('admin.jemaat.index') }}"
               class="group inline-flex items-center gap-2.5 px-4 py-2 mb-4 bg-white border border-slate-200 rounded-full shadow-sm hover:shadow-md hover:border-emerald-300 transition-all duration-300 w-fit cursor-pointer">
                <div class="bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-600 p-1.5 rounded-full transition-colors duration-300">
                    <svg class="w-3.5 h-3.5 transform transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-700 tracking-wide pr-1">Kembali ke Daftar</span>
            </a>

            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Edit Data Jemaat</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Mengubah rincian data untuk <strong class="text-emerald-700">{{ $jemaat->nama_jemaat }}</strong>.</p>
        </div>
    </div>

    {{-- Tampilkan semua error validasi --}}
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

        <form action="{{ route('admin.jemaat.update', $jemaat) }}" method="POST" id="formEditJemaat" onsubmit="return handleUpdate(event, this)" class="p-6 md:p-10 space-y-6 md:space-y-8 mt-2">
            @csrf
            @method('PUT')

            {{-- 1. Informasi Dasar --}}
            <div>
                <h3 class="section-title">Informasi Dasar</h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_jemaat" value="{{ old('nama_jemaat', $jemaat->nama_jemaat) }}" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $jemaat->tempat_lahir) }}" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $jemaat->tanggal_lahir?->format('Y-m-d')) }}" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 appearance-none focus:outline-none cursor-pointer">
                                <option value="L" {{ old('jenis_kelamin', $jemaat->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $jemaat->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Tempat & Tanggal Baptis, Sidi, Nikah --}}
            <div>
                <h3 class="section-title">Tempat &amp; Tanggal Baptis, Sidi, Nikah</h3>
                <div class="space-y-4">
                    {{-- Baptis --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Baptis</label>
                            <input type="text" name="tempat_baptis" value="{{ old('tempat_baptis', $jemaat->tempat_baptis) }}" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Baptis</label>
                            <input type="date" name="tanggal_baptis" value="{{ old('tanggal_baptis', $jemaat->tanggal_baptis?->format('Y-m-d')) }}" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                    </div>

                    {{-- Sidi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Sidi</label>
                            <input type="text" name="tempat_sidi" value="{{ old('tempat_sidi', $jemaat->tempat_sidi) }}" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Sidi</label>
                            <input type="date" name="tanggal_sidi" value="{{ old('tanggal_sidi', $jemaat->tanggal_sidi?->format('Y-m-d')) }}" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                    </div>

                    {{-- Nikah --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Nikah</label>
                            <input type="text" name="tempat_nikah" value="{{ old('tempat_nikah', $jemaat->tempat_nikah) }}" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Nikah</label>
                            <input type="date" name="tanggal_nikah" value="{{ old('tanggal_nikah', $jemaat->tanggal_nikah?->format('Y-m-d')) }}" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Pekerjaan & Status Dalam Jemaat --}}
            <div>
                <h3 class="section-title">Pekerjaan &amp; Status Dalam Jemaat</h3>
                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Pekerjaan</label>
                            <select name="pekerjaan" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 appearance-none focus:outline-none cursor-pointer">
                                <option value="">-- Pilih Pekerjaan --</option>
                                @foreach([
                                    'petani' => 'Petani',
                                    'nelayan' => 'Nelayan',
                                    'tukang' => 'Tukang',
                                    'buruh' => 'Buruh',
                                    'pns' => 'PNS',
                                    'pt' => 'PT',
                                    'swasta' => 'Swasta',
                                    'tni_polri' => 'TNI/POLRI',
                                    'pensiun' => 'Pensiun',
                                    'lainnya' => 'Lainnya',
                                ] as $val => $label)
                                <option value="{{ $val }}" {{ old('pekerjaan', $jemaat->pekerjaan) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Status Dalam Jemaat <span class="text-red-500">*</span></label>
                            <select name="status_dalam_jemaat" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 appearance-none focus:outline-none cursor-pointer">
                                @foreach([
                                    'sidi' => 'Sidi',
                                    'baptis' => 'Baptis',
                                    'belum_baptis' => 'Belum Baptis',
                                    'simpatisan' => 'Simpatisan',
                                ] as $val => $label)
                                <option value="{{ $val }}" {{ old('status_dalam_jemaat', $jemaat->status_dalam_jemaat) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Hub. Keluarga</label>
                            <input type="text" name="hubungan_keluarga" value="{{ old('hubungan_keluarga', $jemaat->hubungan_keluarga) }}" placeholder="Contoh: Kepala Keluarga, Istri, Anak" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 appearance-none focus:outline-none cursor-pointer">
                                <option value="">-- Pilih Pendidikan --</option>
                                @foreach([
                                    'SD' => 'SD',
                                    'SMP' => 'SMP',
                                    'SMA' => 'SMA',
                                    'D3' => 'AMD/D3',
                                    'S1' => 'S1',
                                    'S2' => 'S2',
                                ] as $val => $label)
                                <option value="{{ $val }}" {{ old('pendidikan_terakhir', $jemaat->pendidikan_terakhir) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Kontak & Domisili --}}
            <div>
                <h3 class="section-title">Kontak &amp; Domisili</h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="2" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">{{ old('alamat', $jemaat->alamat) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Wilayah Pelayanan <span class="text-red-500">*</span></label>
                            <select name="id_wilayah" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 appearance-none focus:outline-none cursor-pointer">
                                @foreach($wilayah as $w)
                                <option value="{{ $w->id_wilayah }}" {{ old('id_wilayah', $jemaat->id_wilayah) == $w->id_wilayah ? 'selected' : '' }}>{{ $w->nama_wilayah }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">No. Handphone</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $jemaat->no_hp) }}" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 5. Status & Keanggotaan --}}
            <div>
                <h3 class="section-title">Status &amp; Keanggotaan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Status Jemaat <span class="text-red-500">*</span></label>
                        <select name="status_jemaat" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 appearance-none focus:outline-none cursor-pointer">
                            @foreach(['aktif' => 'Aktif', 'tidak_aktif' => 'Tidak Aktif', 'pindah' => 'Pindah', 'meninggal' => 'Meninggal'] as $val => $label)
                            <option value="{{ $val }}" {{ old('status_jemaat', $jemaat->status_jemaat) == $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Status Pernikahan <span class="text-red-500">*</span></label>
                        <select name="status_pernikahan" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 appearance-none focus:outline-none cursor-pointer">
                            @foreach(['belum_menikah' => 'Belum Menikah', 'menikah' => 'Menikah', 'duda' => 'Duda', 'janda' => 'Janda'] as $val => $label)
                            <option value="{{ $val }}" {{ old('status_pernikahan', $jemaat->status_pernikahan) == $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- 6. Keterangan --}}
            <div>
                <h3 class="section-title">Keterangan</h3>
                <textarea name="keterangan" rows="3" placeholder="Catatan tambahan (opsional)" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">{{ old('keterangan', $jemaat->keterangan) }}</textarea>
            </div>

            {{-- Tombol Aksi --}}
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3">
                <button type="submit" class="w-full sm:w-auto bg-[#143222] text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide hover:bg-emerald-700 transition-all duration-300 shadow-lg shadow-emerald-900/20 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.jemaat.index') }}" class="w-full sm:w-auto bg-white border border-slate-300 text-slate-600 px-8 py-3.5 rounded-xl text-sm font-bold text-center hover:bg-slate-50 transition-all duration-300">Batal</a>
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
            text: 'Data jemaat sedang disimpan ke sistem.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => { Swal.showLoading(); }
        });
        setTimeout(() => { form.submit(); }, 800);
    }

    @if(session('success'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#143222',
                timer: 2500
            });
        });
    @endif
</script>

@endsection
