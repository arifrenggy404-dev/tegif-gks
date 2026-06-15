@extends('layouts.admin')
@section('title', 'Tambah Jemaat')

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
    .section-title {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #10b981;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e2e8f0;
    }
</style>

<div class="max-w-3xl mx-auto pb-10">
    <!-- Header & Navigasi -->
    <div class="mb-8">
        <a href="{{ route('admin.jemaat.index') }}"
           class="group inline-flex items-center gap-2 text-sm text-emerald-700 font-bold hover:text-emerald-900 transition-colors">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Jemaat
        </a>
        <h2 class="text-3xl font-extrabold text-slate-800 mt-2 tracking-tight">Tambah Data Jemaat</h2>
        <p class="text-slate-500 text-sm mt-1">Lengkapi formulir di bawah ini untuk menambahkan jemaat baru.</p>
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

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400"></div>

        <form action="{{ route('admin.jemaat.store') }}" method="POST" id="formTambahJemaat" onsubmit="return handleSimpan(event, this)" class="p-6 md:p-10 space-y-8">
            @csrf

            {{-- ====================== --}}
            {{-- DATA DIRI --}}
            {{-- ====================== --}}
            <div>
                <p class="section-title">Data Diri</p>

                <div class="space-y-6">
                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_jemaat" value="{{ old('nama_jemaat') }}" required placeholder="Masukkan nama lengkap"
                               class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        @error('nama_jemaat')<p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>@enderror
                    </div>

                    {{-- Tempat, Tanggal Lahir & Jenis Kelamin --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required placeholder="Contoh: Waingapu"
                                   class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                                   class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                                <option value="">-- Pilih --</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Domisili <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" required placeholder="Masukkan alamat lengkap"
                                  class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">{{ old('alamat') }}</textarea>
                    </div>

                    {{-- Wilayah & No HP --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Wilayah Pelayanan <span class="text-red-500">*</span></label>
                            <select name="id_wilayah" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                                <option value="">-- Pilih Wilayah --</option>
                                @foreach($wilayah as $w)
                                <option value="{{ $w->id_wilayah }}" {{ old('id_wilayah') == $w->id_wilayah ? 'selected' : '' }}>{{ $w->nama_wilayah }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">No. Handphone</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxx"
                                   class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====================== --}}
            {{-- TEMPAT/TGL BAPTIS, SIDI, NIKAH --}}
            {{-- ====================== --}}
            <div>
                <p class="section-title">Tempat &amp; Tanggal Baptis, Sidi, Nikah</p>

                <div class="space-y-4">
                    {{-- Baptis --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Baptis</label>
                            <input type="text" name="tempat_baptis" value="{{ old('tempat_baptis') }}" placeholder="Contoh: GKS Kanatang"
                                   class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Baptis</label>
                            <input type="date" name="tanggal_baptis" value="{{ old('tanggal_baptis') }}"
                                   class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                    </div>

                    {{-- Sidi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Sidi</label>
                            <input type="text" name="tempat_sidi" value="{{ old('tempat_sidi') }}" placeholder="Contoh: GKS Kanatang"
                                   class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Sidi</label>
                            <input type="date" name="tanggal_sidi" value="{{ old('tanggal_sidi') }}"
                                   class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                    </div>

                    {{-- Nikah --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Nikah</label>
                            <input type="text" name="tempat_nikah" value="{{ old('tempat_nikah') }}" placeholder="Contoh: GKS Kanatang"
                                   class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Nikah</label>
                            <input type="date" name="tanggal_nikah" value="{{ old('tanggal_nikah') }}"
                                   class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====================== --}}
            {{-- PEKERJAAN, STATUS DALAM JEMAAT, HUB. KEL, PENDIDIKAN --}}
            {{-- ====================== --}}
            <div>
                <p class="section-title">Pekerjaan &amp; Status Dalam Jemaat</p>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Pekerjaan --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Pekerjaan</label>
                            <select name="pekerjaan" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
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
                                <option value="{{ $val }}" {{ old('pekerjaan') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status Dalam Jemaat --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Status Dalam Jemaat <span class="text-red-500">*</span></label>
                            <select name="status_dalam_jemaat" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                                @foreach([
                                    'sidi' => 'Sidi',
                                    'baptis' => 'Baptis',
                                    'belum_baptis' => 'Belum Baptis',
                                    'simpatisan' => 'Simpatisan',
                                ] as $val => $label)
                                <option value="{{ $val }}" {{ old('status_dalam_jemaat', 'belum_baptis') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Hubungan Keluarga --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Hub. Keluarga</label>
                            <input type="text" name="hubungan_keluarga" value="{{ old('hubungan_keluarga') }}" placeholder="Contoh: Kepala Keluarga, Istri, Anak"
                                   class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">
                        </div>

                        {{-- Pendidikan Terakhir --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                                <option value="">-- Pilih Pendidikan --</option>
                                @foreach([
                                    'SD' => 'SD',
                                    'SMP' => 'SMP',
                                    'SMA' => 'SMA',
                                    'D3' => 'AMD/D3',
                                    'S1' => 'S1',
                                    'S2' => 'S2',
                                ] as $val => $label)
                                <option value="{{ $val }}" {{ old('pendidikan_terakhir') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====================== --}}
            {{-- STATUS JEMAAT & PERNIKAHAN --}}
            {{-- ====================== --}}
            <div>
                <p class="section-title">Status Jemaat</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Status Jemaat <span class="text-red-500">*</span></label>
                        <select name="status_jemaat" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                            @foreach(['aktif' => 'Aktif', 'tidak_aktif' => 'Tidak Aktif', 'pindah' => 'Pindah', 'meninggal' => 'Meninggal'] as $val => $label)
                            <option value="{{ $val }}" {{ old('status_jemaat', 'aktif') == $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Status Pernikahan <span class="text-red-500">*</span></label>
                        <select name="status_pernikahan" required class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none cursor-pointer">
                            @foreach(['belum_menikah' => 'Belum Menikah', 'menikah' => 'Menikah', 'duda' => 'Duda', 'janda' => 'Janda'] as $val => $label)
                            <option value="{{ $val }}" {{ old('status_pernikahan', 'belum_menikah') == $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- ====================== --}}
            {{-- KETERANGAN --}}
            {{-- ====================== --}}
            <div>
                <p class="section-title">Keterangan</p>
                <textarea name="keterangan" rows="3" placeholder="Catatan tambahan (opsional)"
                          class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none">{{ old('keterangan') }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3">
                <button type="submit"
                        class="w-full sm:w-auto bg-[#143222] text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-900/20 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Simpan Data Jemaat
                </button>
                <a href="{{ route('admin.jemaat.index') }}"
                   class="w-full sm:w-auto bg-white border border-slate-300 text-slate-600 px-8 py-3.5 rounded-xl text-sm font-bold text-center hover:bg-slate-50 transition-all">
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
            text: 'Data jemaat baru sedang ditambahkan.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => { Swal.showLoading(); }
        });
        setTimeout(() => { form.submit(); }, 800);
    }
</script>

@endsection
