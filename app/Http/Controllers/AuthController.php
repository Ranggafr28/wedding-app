<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CustomerModels;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function signup()
    {
        return view('auth.signup');
    }
    // function handle daftar akun customer
    public function signupCustomer(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'phone' => 'required',
        ]);
        $uuid = Str::uuid();
        $now = now();
        $hashedPassword = Hash::make($request->password);
        $result = CustomerModels::create([
            'user_id' => $uuid,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'created_at' => $now,
        ]);

        if ($result) {
            User::create([
                'user_id' => $uuid,
                'fullname' => $request->fullname,
                'username' => $request->username,
                'password' => $hashedPassword,
                'role' => 'customer',
                'created_at' => $now,
            ]);
            return redirect()->route('login')->with('success', 'Berhasil mendaftarkan akun');
        }
        return back()->with('error', 'Maaf!, Inputan tidak boleh kosong')->withInput(old('role'));
    }

    public function authLogin(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended('/apps');
        }
        return back()->with('loginError', 'Maaf!, Username atau Password Anda Salah!')->withInput(old('username'));
    }
    public function authLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
