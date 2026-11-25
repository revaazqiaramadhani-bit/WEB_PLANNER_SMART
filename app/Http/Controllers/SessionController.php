<?php

 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SessionController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('sesi.index');
    }

    public function register()
    {
        return view('sesi.register');
    }

    public function storeRegistration(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create($validated);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/plans')->with('success', 'Akun berhasil dibuat. Selamat datang!');
    }

    // Memproses data login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Cek kecocokan data login
        if (Auth::attempt($infologin)) {
            // Jika berhasil, arahkan ke halaman plans/dashboard
            return redirect('/plans')->with('success', 'Berhasil Login');
        } else {
            // Jika gagal, kembalikan ke halaman login dengan pesan error
            return redirect('/login')->withErrors('Username dan password yang dimasukkan tidak valid');
        }
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout');
    }
}

