@extends('layouts.admin')
@section('title','Edit User')
@section('content')
<div class="max-w-lg">
    <div class="mb-6"><a href="{{ route('admin.user.index') }}" class="text-sm text-slate-400">← Kembali</a><h2 class="text-2xl font-bold text-slate-800 mt-1">Edit User — {{ $user->nama }}</h2></div>
    <div class="bg-white rounded-xl border border-slate-200 p-6">
        <form action="{{ route('admin.user.update', $user) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" required class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Role</label>
                <select name="role" required class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach(['pengurus'=>'Pengurus','bendahara'=>'Bendahara','admin'=>'Admin'] as $val=>$label)
                    <option value="{{ $val }}" {{ old('role',$user->role)==$val ? 'selected':'' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Password Baru <span class="text-slate-400 font-normal">(kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-800 transition">Update</button>
                <a href="{{ route('admin.user.index') }}" class="border border-slate-300 text-slate-600 px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-slate-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection