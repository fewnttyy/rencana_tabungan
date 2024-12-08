<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
        ], [
            'email.unique' => 'email tersebut sudah digunakan.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        UserModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.form')->with('success', 'Akun berhasil didaftarkan. Silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = UserModel::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['id_user' => $user->id_user, 'user_name' => $user->name]);

            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return back()->with('error', 'email atau password salah.');
    }

    public function logout()
    {
        session()->flush(); // Hapus semua session
        return redirect()->route('login.form')->with('success', 'Anda berhasil logout.');
    }
}