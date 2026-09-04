<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('username', $credentials['username'])->first();
        
        if (!$user) {
            return back()->with('failed', 'Username atau Password tidak sesuai');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return back();
    }

    function showLoginForm() {
        $pageTitle = 'Login';
        return view('auth.login', compact('pageTitle'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
