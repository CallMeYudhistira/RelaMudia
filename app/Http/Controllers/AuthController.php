<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        throw ValidationException::withMessages([
            'error' => 'Email atau Password Salah!'
        ]);
    }

    public function register(Request $request){
        $validation = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $validation['password'] = Hash::make($validation['password']);
        $validation['role'] = 'user';

        $user = User::create($validation);
        if($user){
            $request->session()->regenerate();
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        throw ValidationException::withMessages([
            'error' => 'Terjadi Kesalahan!'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/');
    }
}
