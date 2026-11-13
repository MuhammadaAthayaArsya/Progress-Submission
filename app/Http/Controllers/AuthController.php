<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /** GET /login : tampilkan form login. */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /** POST /login : validasi input lalu coba autentikasi. */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate(
            [
                'email'    => ['required', 'email'],
                'password' => ['required', 'string'],
            ],
            [
                'required' => ':attribute wajib diisi.',
                'email'    => 'Format :attribute tidak valid.',
            ],
            [
                'email'    => 'Email',
                'password' => 'Password',
            ]
        );

        // Auth::attempt() mencocokkan email + membandingkan hash password.
        // Argumen kedua = fitur "Ingat saya" (remember me).
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Wajib: ganti session ID setelah login untuk mencegah session fixation
            $request->session()->regenerate();

            // intended() = kembali ke halaman yang tadinya dituju sebelum dilempar ke /login,
            // atau ke daftar aset jika tidak ada.
            return redirect()->intended(route('pc-assets.index'))
                ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        // Kredensial salah: kembali ke form, email tetap terisi, tampilkan pesan error
        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    /** POST /logout : akhiri sesi login. */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Hapus seluruh data session dan buat token CSRF baru
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda berhasil logout.');
    }
}