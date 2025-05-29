<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            $user = User::find(Auth::id());
            if ($user) {
                $user->logged_in += 1;
                $user->is_online = true;
                $user->save();
            }

            return redirect()->route('dashboard');
        }

        return redirect()->route('loginForm')->withInput($request->only('username'))->with('error', 'Akun atau kata sandi salah.');
    }

    /**
     * Handle a logout request to the application.
     */
    public function logout(Request $request)
    {
        $user = User::find(Auth::id());
        if ($user) {
            $user->is_online = false;
            $user->save();
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginForm')->with('success', 'Anda telah berhasil keluar.');
    }
}
