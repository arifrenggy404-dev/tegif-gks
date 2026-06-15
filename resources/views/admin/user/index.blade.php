@extends('layouts.admin')
@section('title','Kelola User')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Kelola User</h2>
        <p class="text-slate-500 text-sm">Admin, pengurus, dan bendahara</p>
    </div>
    <a href="{{ route('admin.user.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-800 transition">+ Tambah User</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($users as $u)
    <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md transition flex flex-col gap-3">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center text-sm font-bold">
                {{ strtoupper(substr($u->nama,0,1)) }}
            </div>
            <div class="min-w-0">
                <p class="font-semibold text-slate-800 truncate">
                    {{ $u->nama }}
                    @if($u->id_user === Auth::id())
                        <span class="text-xs text-slate-400 font-normal">(Anda)</span>
                    @endif
                </p>
                <p class="text-xs text-slate-400 truncate">@{{ $u->username }}</p>
            </div>
        </div>

        <div class="text-sm text-slate-500 truncate">
            {{ $u->email }}
        </div>

        <div>
            @php
                $rc = match($u->role){
                    'admin' => 'bg-blue-100 text-blue-700',
                    'bendahara' => 'bg-green-100 text-green-700',
                    default => 'bg-slate-100 text-slate-600'
                };
            @endphp
            <span class="px-2 py-0.5 rounded text-xs font-medium {{ $rc }} capitalize">{{ $u->role }}</span>
        </div>

        <div class="flex items-center gap-3 pt-2 border-t border-slate-100 mt-auto">
            <a href="{{ route('admin.user.edit', $u) }}" class="text-blue-600 hover:underline text-xs font-medium">Edit</a>
            @if($u->id_user !== Auth::id())
            <form action="{{ route('admin.user.destroy', $u) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                @csrf
                @method('DELETE')
                <button class="text-red-500 hover:underline text-xs font-medium">Hapus</button>
            </form>
            @endif
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-10 text-slate-400 bg-white rounded-xl border border-slate-200">
        Belum ada user.
    </div>
    @endforelse
</div>

<div class="mt-4">{{ $users->links() }}</div>
@endsection
