<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Auth::attempt akan mengecek email & password ke database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Cek role dan arahkan ke dashboard masing-masing
            $role = Auth::user()->role;
            if ($role == 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($role == 'doctor' || $role == 'dokter') {
                return redirect('/doctor/dashboard');
            } else {
                return redirect('/patients'); // Default Resepsionis
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}