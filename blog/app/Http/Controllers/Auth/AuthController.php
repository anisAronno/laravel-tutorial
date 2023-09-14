<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        $response =  Auth::attempt($request->only('email', 'password'));
        if($response) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->with('message', 'Wrong Credential.');
    }

    public function me()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function passwordReset()
    {
        return view('auth.passwordReset');
    }

    public function passwordResetProcess(Request $request)
    {
        $user = auth()->user();

        if(Hash::check($request->old_password, $user->password)) {
            User::where('id', $user->id)->update(['password' => $request->password]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('message', 'Old password Does not match.');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
