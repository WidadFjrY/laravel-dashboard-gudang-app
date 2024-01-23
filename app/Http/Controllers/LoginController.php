<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'Masuk',
            'name' => 'Widad',
            'icon' => 'bi-person-fill'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credential = $request->validate(
            [
                'email' => 'required|email:dns',
                'password' => 'required'
            ]
        );

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Email atau Kata Sandi Salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
