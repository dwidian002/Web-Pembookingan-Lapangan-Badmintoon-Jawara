<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function prosesRegister(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        // Buat data pengguna dengan peran default 'pelanggan'
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan',
            'email_verified_at' => Carbon::now() // Set role default to 'pelanggan'
        ]);

        Auth::login($user);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('auth.index'));
        } else {
            return redirect(route('auth.register'))->with('pesan', 'Gagal Mendaftarkan Akun. Silahkan Coba Lagi');
        }
    }


    public function verify(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('user')->user();
            if ($user->role == 'pelanggan') {
                return redirect()->route('booking.list');
            } else {
                return redirect()->intended('/admin');
            }
        } else {
            return redirect(route('auth.index'))->with('pesan', 'kombinasi email dan password salah');
        }
    }


    public function logout()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
        return redirect(route('auth.index'));
    }
}
