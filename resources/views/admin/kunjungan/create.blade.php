@extends('layouts.admin')
@section('title','Tambah Kunjungan')
@section('content')
<div class="max-w-lg">
    <div class="mb-6"><a href="{{ route('admin.kunjungan.index') }}" class="text-sm text-slate-400 hover:text-slate-600">← Kembali</a><h2 class="text-2xl font-bold text-slate-800 mt-1">Tambah Kunjungan</h2></div>
    <div class="bg-white rounded-xl border border-slate-200 p-6">
        <form action="{{ route('admin.kunjungan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tujuan Kunjungan</label>
                <textarea name="tujuan" rows="3" required class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('tujuan') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Waktu Kunjungan</label>
                <input type="datetime-local" name="waktu_kunjungan" value="{{ old('waktu_kunjungan') }}" required class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Wilayah</label>
                <select name="id_wilayah" required class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Wilayah --</option>
                    @foreach($wilayah as $w)
                    <option value="{{ $w->id_wilayah }}" {{ old('id_wilayah')==$w->id_wilayah ? 'selected':'' }}>{{ $w->nama_wilayah }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-800 transition">Simpan</button>
                <a href="{{ route('admin.kunjungan.index') }}" class="border border-slate-300 text-slate-600 px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-slate-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection