<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Controller; // ⬅️ WAJIB INI

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            return redirect('/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }
    public function registerForm()
{
    return view('auth.register');
}

public function register(Request $request)
{
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/login')->with('success', 'Registrasi berhasil, silakan login');
}

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
