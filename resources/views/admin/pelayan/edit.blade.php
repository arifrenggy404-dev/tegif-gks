@extends('layouts.admin')
@section('title', 'Edit Pelayan')

@section('content')

    {{-- Custom CSS Khusus Form --}}
    <style>
        /* Efek bayangan halus pada card form */
        .form-card-shadow {
            box-shadow: 0 10px 40px -10px rgba(20, 50, 34, 0.08);
        }

        /* Animasi glow pada input saat difokuskan */
        .input-modern {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-modern:focus {
            border-color: #10b981;
            /* Emerald 500 */
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
            transform: translateY(-1px);
        }

        /* Mengatasi warna background kuning/biru bawaan browser saat Autofill */
        input:-webkit-autofill,
        select:-webkit-autofill {
            -webkit-box-shadow: 0 0 0px 1000px #ffffff inset !important;
            -webkit-text-fill-color: #1e293b !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>

    <div class="max-w-3xl mx-auto pb-10">

        <!-- ══ HEADER & TOMBOL KEMBALI ══ -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <!-- Tombol Kembali Modern (Pills Style) -->
                <a href="{{ route('admin.pelayan.index') }}"
                    class="group inline-flex items-center gap-2.5 px-4 py-2 mb-4 bg-white border border-slate-200 rounded-full shadow-sm hover:shadow-md hover:border-emerald-300 transition-all duration-300 w-fit cursor-pointer">
                    <div
                        class="bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-600 p-1.5 rounded-full transition-colors duration-300">
                        <svg class="w-3.5 h-3.5 transform transition-transform group-hover:-translate-x-1" fill="none"
                            stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-700 tracking-wide pr-1">Kembali
                        ke Daftar</span>
                </a>

                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Edit Data Pelayan</h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Mengubah rincian penugasan untuk <strong
                        class="text-emerald-700">{{ $pelayan->nama_pelayan }}</strong>.</p>
            </div>
        </div>

        <!-- ══ FORM CONTAINER ══ -->
        <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden form-card-shadow relative">

            <!-- Ornamen Garis Hijau Atas -->
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#143222] via-emerald-600 to-teal-400">
            </div>

            <form action="{{ route('admin.pelayan.update', $pelayan) }}" method="POST" id="formEditPelayan"
                onsubmit="return handleUpdate(event, this)" class="p-6 md:p-10 space-y-6 mt-2">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    {{-- 1. Nama Pelayan --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Pelayan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_pelayan" value="{{ old('nama_pelayan', $pelayan->nama_pelayan) }}"
                            required placeholder="Masukkan nama lengkap pelayan..."
                            class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none">
                        @error('nama_pelayan')
                            <p class="text-red-500 text-xs font-bold mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- 2. Jenis Pelayanan --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Tugas/Pelayanan <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="jenis" required
                                class="input-modern w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 appearance-none focus:outline-none cursor-pointer">
                                @foreach (['pendeta', 'mejelis', 'vikaris'] as $j)
                                    <option value="{{ $j }}"
                                        {{ old('jenis', $pelayan->jenis) == $j ? 'selected' : '' }}>
                                        {{ ucfirst($j) }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- 3. Status Aktif --}}
                    <div class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                        <input type="checkbox" name="aktif" id="aktif" value="1"
                            {{ old('aktif', $pelayan->aktif) ? 'checked' : '' }}
                            class="w-5 h-5 text-emerald-600 bg-white border-slate-300 rounded focus:ring-emerald-500 focus:ring-2 cursor-pointer transition-all">
                        <label for="aktif" class="text-sm font-bold text-slate-700 cursor-pointer select-none">
                            Status Aktif
                            <p class="text-xs font-normal text-slate-500 mt-0.5">Hapus centang jika pelayan ini sedang cuti
                                atau tidak aktif bertugas.</p>
                        </label>
                    </div>
                </div>

                {{-- 4. Tombol Aksi --}}
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3">
                    <button type="submit"
                        class="w-full sm:w-auto bg-[#143222] text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide
                           hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300
                           shadow-lg shadow-emerald-900/20 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.pelayan.index') }}"
                        class="w-full sm:w-auto bg-white border border-slate-300 text-slate-600 px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide
                          hover:bg-slate-50 hover:border-slate-400 hover:text-slate-800 transition-all duration-300 text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Script SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Efek Loading Instan Saat Tombol Update Diklik
        function handleUpdate(event, form) {
            event.preventDefault(); // Tahan form sejenak

            Swal.fire({
                title: 'Memperbarui Data...',
                text: 'Harap tunggu, perubahan sedang disimpan.',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading(); // Tampilkan roda berputar (loading)
                }
            });

            // Teruskan form ke controller setelah 800ms
            setTimeout(() => {
                form.submit();
            }, 800);
        }

        // Menangkap Popup Sukses / Gagal setelah Redirect kembali dari Controller
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#143222', // Tema Dark Green/Emerald
                    timer: 2500,
                    timerProgressBar: true
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memperbarui!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#d33'
                });
            @endif
        });
    </script>

@endsection
