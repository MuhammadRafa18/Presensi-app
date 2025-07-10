<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller

{
    public function Login()
    {
        return view('Login.login');
    }
    public function login_proses(LoginRequest $request)
    {

        $validated = $request->validated();
        $data = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard')->with('success', 'berhasil login');
        } else {
            return redirect()->route('Login')->with('failed', 'Username atau Password salah!');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('Login')->with('success', 'Berhasil Logout');
    }
}
