<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Kalau sudah login, langsung arahkan sesuai role
        if (Auth::check()) {
            return $this->redirectByRole();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $key = 'login:' . Str::lower($request->username) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'username' => "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            $redirect = $this->redirectByRole();

            // Kalau role tidak dikenali, redirectByRole() akan logout
            // dan mengembalikan null -> tampilkan pesan error.
            if ($redirect === null) {
                return back()->withErrors(['username' => 'Akun tidak memiliki akses.']);
            }

            return $redirect;
        }

        RateLimiter::hit($key, 60);

        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    /**
     * Arahkan user ke dashboard/halaman sesuai role-nya.
     * Mengembalikan null kalau role tidak dikenali (lalu logout).
     */
    private function redirectByRole(): ?RedirectResponse
    {
        return match (Auth::user()->role) {
            'admin'     => redirect()->route('admin.dashboard'),
            'bendahara' => redirect()->route('bendahara.dashboard'),
            'pengurus'      => redirect()->route('pengurus.dashboard'),
            default     => (function () {
                Auth::logout();
                return null;
            })(),
        };
    }
}
