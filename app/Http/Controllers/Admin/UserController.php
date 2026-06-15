<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{   /**
     * Tampilkan semua user (Read - Index)
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter pencarian opsional
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter role opsional
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('nama')->paginate(15)->withQueryString();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Form tambah user baru (Create - Form)
     */
    public function create()
    {
        $roles = ['admin', 'pengurus', 'bendahara'];
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Simpan user baru ke database (Create - Store)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,pengurus,bendahara',
        ], [
            'username.unique'   => 'Username sudah digunakan.',
            'email.unique'      => 'Email sudah terdaftar.',
            'password.min'      => 'Password minimal 8 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.user.index')
                         ->with('success', "User {$validated['username']} berhasil ditambahkan.");
    }

    /**
     * Tampilkan detail satu user (Read - Show)
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Form edit user (Update - Form)
     */
    public function edit(User $user)
    {
        $roles = ['admin', 'pengurus', 'bendahara'];
        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Simpan perubahan user (Update - Store)
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => [
                'required', 'string', 'max:50',
                Rule::unique('users', 'username')->ignore($user->id_user, 'id_user'),
            ],
            'nama'     => 'required|string|max:100',
            'email'    => [
                'required', 'email', 'max:100',
                Rule::unique('users', 'email')->ignore($user->id_user, 'id_user'),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:admin,pengurus,bendahara',
        ], [
            'username.unique'   => 'Username sudah digunakan.',
            'email.unique'      => 'Email sudah terdaftar.',
            'password.min'      => 'Password minimal 8 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        // Hanya update password kalau diisi
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
                         ->with('success', "User {$user->username} berhasil diperbarui.");
    }

    /**
     * Hapus user (Delete)
     */
    public function destroy(User $user)
    {
        // Cegah hapus diri sendiri
        if (auth()->id() === $user->id_user) {
            return redirect()->route('admin.user.index')
                             ->with('error', 'Tidak dapat menghapus akun yang sedang digunakan.');
        }

        $username = $user->username;
        $user->delete();

        return redirect()->route('admin.user.index')
                         ->with('success', "User {$username} berhasil dihapus.");
    }

}
