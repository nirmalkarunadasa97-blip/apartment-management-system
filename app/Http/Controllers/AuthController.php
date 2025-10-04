<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $credentials = array_merge($credentials, ['is_active' => '1']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->user_role_id == 1) {
                return redirect()->route('addash.index');
            } elseif (auth()->user()->user_role_id == 2) {
                return redirect()->route('admin_maintenance.index');
            } elseif (auth()->user()->user_role_id == 3) {
                return redirect()->route('resdash.index');
            }
        }

        return back()->withErrors([
            'email' => 'Email or Password incorrect',
        ])->onlyInput('email');
    }
}
