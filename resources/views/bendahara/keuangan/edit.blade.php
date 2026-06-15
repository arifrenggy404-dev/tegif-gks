@extends('layouts.bendahara')
@section('title', 'Edit Transaksi')
@section('content')

<div class="max-w-xl mx-auto px-2 py-2 sm:py-4">
    <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div class="order-2 sm:order-1">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-stone-800 tracking-tight flex items-center gap-2">
                <span class="w-1.5 sm:w-2 h-7 sm:h-8 bg-[#143222] rounded-full inline-block"></span>
                Edit Transaksi
            </h2>
            <p class="text-stone-500 text-xs sm:text-sm mt-1 pl-3 sm:pl-4">Perbarui data arus kas jemaat yang telah dicatat</p>
        </div>

        <div class="order-1 sm:order-2 self-start sm:self-auto">
            <a href="{{ route('bendahara.keuangan.index') }}"
               class="inline-flex items-center gap-2 px-3.5 py-2 bg-white border border-stone-200 hover:border-emerald-300 hover:bg-emerald-50 text-stone-600 hover:text-emerald-800 rounded-xl text-xs sm:text-sm font-bold transition-all shadow-sm group w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 p-5 sm:p-6 md:p-8 shadow-sm">
        <form action="{{ route('bendahara.keuangan.update', $keuangan) }}" method="POST" class="space-y-5 sm:space-y-6">
            @csrf
            @method('PUT')

            {{-- Pilih jenis dengan toggle visual --}}
            <div>
                <label class="block text-xs sm:text-sm font-bold text-stone-700 mb-2.5 sm:mb-3">Jenis Transaksi</label>
                <div class="grid grid-cols-2 gap-3 sm:gap-4">
                    <label class="cursor-pointer group">
                        <input type="radio" name="jenis_transaksi" value="pemasukan"
                               class="sr-only peer"
                               {{ old('jenis_transaksi', $keuangan->jenis_transaksi) === 'pemasukan' ? 'checked' : '' }}>
                        <div class="border-2 rounded-xl p-3.5 sm:p-4 text-center transition-all duration-200 bg-stone-50/50 border-stone-200 group-hover:bg-stone-50 peer-checked:border-emerald-600 peer-checked:bg-emerald-50/40 peer-checked:shadow-sm">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center mx-auto text-lg sm:text-xl font-bold mb-2 transition-transform group-hover:scale-110">
                                ➔
                            </div>
                            <p class="font-bold text-xs sm:text-sm text-stone-700 peer-checked:text-emerald-800">Pemasukan</p>
                        </div>
                    </label>

                    <label class="cursor-pointer group">
                        <input type="radio" name="jenis_transaksi" value="pengeluaran"
                               class="sr-only peer"
                               {{ old('jenis_transaksi', $keuangan->jenis_transaksi) === 'pengeluaran' ? 'checked' : '' }}>
                        <div class="border-2 rounded-xl p-3.5 sm:p-4 text-center transition-all duration-200 bg-stone-50/50 border-stone-200 group-hover:bg-stone-50 peer-checked:border-rose-500 peer-checked:bg-rose-50/40 peer-checked:shadow-sm">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto text-lg sm:text-xl font-bold mb-2 transition-transform group-hover:scale-110 rotate-180">
                                ➔
                            </div>
                            <p class="font-bold text-xs sm:text-sm text-stone-700 peer-checked:text-rose-800">Pengeluaran</p>
                        </div>
                    </label>
                </div>
                @error('jenis_transaksi')
                    <p class="text-rose-600 text-xs font-semibold mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            {{-- Kolom Tanggal --}}
            <div>
                <label class="block text-xs sm:text-sm font-bold text-stone-700 mb-1.5">Tanggal</label>
                <input type="date" name="tanggal_transaksi"
                       value="{{ old('tanggal_transaksi', $keuangan->tanggal_transaksi->format('Y-m-d')) }}"
                       required
                       class="w-full px-3.5 py-2.5 bg-white border border-stone-200 rounded-xl text-stone-800 font-medium focus:outline-none focus:border-[#143222] focus:ring-4 focus:ring-emerald-50/50 transition-all text-xs sm:text-sm shadow-sm cursor-pointer">
                @error('tanggal_transaksi')
                    <p class="text-rose-600 text-xs font-semibold mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            {{-- Kolom Jumlah (Dioptimalkan untuk Keyboard Numpad HP) --}}
            <div>
                <label class="block text-xs sm:text-sm font-bold text-stone-700 mb-1.5">Jumlah (Rp)</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span class="text-stone-400 text-xs sm:text-sm font-bold tracking-wide">Rp</span>
                    </div>
                    <input type="number" name="total" id="input-total"
                           value="{{ old('total', $keuangan->total) }}"
                           min="0" step="1000" required
                           inputmode="numeric" pattern="[0-9]*"
                           class="w-full pl-11 pr-4 py-2.5 bg-white border border-stone-200 rounded-xl text-stone-800 font-bold placeholder-stone-300 focus:outline-none focus:border-[#143222] focus:ring-4 focus:ring-emerald-50/50 transition-all text-xs sm:text-sm">
                </div>
                @error('total')
                    <p class="text-rose-600 text-xs font-semibold mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-xs sm:text-sm font-bold text-stone-700 mb-1.5">Keterangan</label>
                <textarea name="keterangan" rows="3"
                          placeholder="Contoh: Persembahan minggu ke-1, Pembelian ATK, dll."
                          class="w-full px-3.5 py-2.5 bg-white border border-stone-200 rounded-xl text-stone-800 placeholder-stone-300 focus:outline-none focus:border-[#143222] focus:ring-4 focus:ring-emerald-50/50 transition-all text-xs sm:text-sm shadow-sm resize-none leading-relaxed">{{ old('keterangan', $keuangan->keterangan) }}</textarea>
                @error('keterangan')
                    <p class="text-rose-600 text-xs font-semibold mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit"
                        class="w-full sm:flex-1 order-2 sm:order-1 bg-[#143222] hover:bg-[#1b442e] text-white px-5 py-3 rounded-xl text-xs sm:text-sm font-bold shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-emerald-800/20">
                    Update Transaksi
                </button>
                <a href="{{ route('bendahara.keuangan.index') }}"
                   class="w-full sm:w-auto order-1 sm:order-2 px-5 py-3 bg-white text-stone-700 hover:bg-rose-50 hover:text-rose-700 border border-stone-200 hover:border-rose-200 rounded-xl text-xs sm:text-sm font-bold transition-all shadow-sm text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Proteksi Tambahan Validasi Angka di Sisi Klien --}}
<script>
    document.getElementById('input-total').addEventListener('keydown', function(e) {
        if (['e', 'E', '+', '-', '.', ','].includes(e.key)) {
            e.preventDefault();
        }
    });
</script>

@endsection
