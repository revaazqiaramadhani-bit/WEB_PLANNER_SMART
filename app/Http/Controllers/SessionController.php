<?php

 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('sesi.index');
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

