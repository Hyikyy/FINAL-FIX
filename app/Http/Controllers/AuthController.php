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
    // Fungsi untuk memproses login
public function login(Request $request)
{
    // Tentukan field mana yang akan digunakan untuk login (NIM atau Username)
    // Contoh: login menggunakan NIM
    $loginField = 'nim'; // Atau bisa juga 'username'

    $credentials = $request->validate([
        $loginField => 'required|string', // Validasi untuk NIM atau Username
        'password' => 'required',
    ]);

    // Sesuaikan array credentials untuk Auth::attempt()
    $authCredentials = [
        $loginField => $credentials[$loginField],
        'password' => $credentials['password']
    ];

    // Jika Anda ingin mengizinkan login dengan NIM ATAU Username
    // Anda perlu logika tambahan:
    // $loginValue = $request->input('login_identifier'); // Misal input field di form bernama 'login_identifier'
    // $fieldType = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : (is_numeric($loginValue) ? 'nim' : 'username');
    // $authCredentials = [
    //     $fieldType => $loginValue,
    //     'password' => $request->password
    // ];
    // Tapi untuk sekarang, kita asumsikan login hanya dengan satu field (misal NIM)

    if (Auth::attempt($authCredentials)) { // Gunakan $authCredentials yang sudah disesuaikan
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('welcome');
        }
    }

    return back()->withErrors([
        // Ganti pesan error agar sesuai
        $loginField => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
    ])->withInput($request->only($loginField)); // Kembalikan input loginField
}


    // Fungsi untuk memproses registrasi
public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'nim' => 'required|string|max:255|unique:users,nim', // Validasi NIM, pastikan unik di tabel users kolom nim
        'username' => 'required|string|max:255|unique:users,username', // Validasi Username, unik
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    try {
        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('welcome'); // Atau 'home'

    } catch (\Exception $e) {
        \Log::error('Error during registration: ' . $e->getMessage() . ' Stack trace: ' . $e->getTraceAsString());
        return back()->withErrors(['error' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.'])->withInput();
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
