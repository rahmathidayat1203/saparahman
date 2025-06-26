<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthControllerWeb extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi menggunakan no_wa
        $request->validate([
            'name' => 'required|string|max:255',
            'no_wa' => 'required|string|unique:users,no_wa',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'no_wa' => $request->no_wa,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah registrasi
        $credentials = $request->only('no_wa', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'no_wa' => 'Registration failed. Please try again.',
        ])->onlyInput('no_wa', 'name');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi login dengan no_wa
        $credentials = $request->validate([
            'no_wa' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'no_wa' => 'The provided credentials do not match our records.',
        ])->onlyInput('no_wa');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
