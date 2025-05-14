<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Import Model User
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    // Fungsi untuk menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan view 'auth.login' ada
    }

    // Fungsi untuk menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register'); // Pastikan view 'auth.register' ada
    }

    // Fungsi untuk memproses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek apakah user adalah admin (contoh: berdasarkan kolom 'role')
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
            } else {
                return redirect()->route('welcome'); // Redirect ke halaman welcome (beranda)
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email')); // Mengembalikan input email agar tidak perlu diisi ulang
    }


    // Fungsi untuk memproses registrasi
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin', // Validasi role
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role, // Simpan role
            ]);

            Auth::login($user); // Login user setelah registrasi

            // Redirect berdasarkan role
            if ($request->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Gunakan route name untuk admin
            } else {
                return redirect()->route('home'); // Gunakan route name untuk user
            }
        } catch (\Exception $e) {
            // Log error (gunakan logger Laravel)
            \Log::error('Error during registration: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.'])->withInput(); // Pesan error umum
        }
    }


    // Fungsi untuk logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Redirect ke halaman login
    }
}