<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index');
    }

    public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return back()->with('success', 'Profil berhasil diperbarui!');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|current_password',
        'new_password' => 'required|min:8|confirmed',
    ]);

    if($request->new_password == $request->current_password){
        throw ValidationException::withMessages([
            'current_password' => 'The new password still same with current password!'
        ]);
    }

    auth()->user()->update([
        'password' => Hash::make($request->new_password),
    ]);

    return back()->with('success', 'Password berhasil diganti!');
}
}
