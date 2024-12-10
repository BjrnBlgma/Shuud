<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user();
            if ($user->role_id == 1 || $user->role_id == 2 || $user->role_id == 11) {
                return redirect()->route('admin');
            }
            return redirect()->intended('/main');
        }
        return back()->withErrors([
            'email' => 'Неверный email или пароль',
        ])->onlyInput('email');
    }


//    public function checkAuth()
//    {
//        if (auth()->user()) {
//            $user = auth()->user();
//            $admin = User::with("role")->findOrFail($user->id);
//            if ($admin->role->name ==('Администратор' || 'Суперадминистратор')) {
//                return redirect()->route('admin');
//            } else {
//                return redirect()->route('main');
//            }
//        }
//        return redirect()->route('login');
//    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Вы вышли из системы');
    }
}
