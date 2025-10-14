<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginFrom()
    {
        return view('auth.login'); // Menampilkan form login
    }

    public function login(Request $request)
    {
        // validasi input
        $credentials = $request->only('email', 'password');

        // coba autentikasi
        if (Auth::attempt($credentials)) {
            // login berhasil
            return redirect()->intended('dashboard'); // Ganti 'dashboard' dengan rute tujuan setelah login
        }

        // gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',    
        ]); // Mengembalikan hanya input email
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login'); // Ganti '/login' dengan rute tujuan setelah logout
    }

}
