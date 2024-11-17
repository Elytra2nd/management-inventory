<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengelolaGudang;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (session()->has('pengelola_gudang_id')) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $pengelola = PengelolaGudang::where('username', $request->username)->first();

        if ($pengelola && Hash::check($request->password, $pengelola->password)) {
            // Set session
            session([
                'pengelola_gudang_id' => $pengelola->pengelola_gudang_id,
                'nama_pengelola' => $pengelola->nama
            ]);

            // Catat aktivitas login
            LogAktivitas::create([
                'username_id' => $pengelola->pengelola_gudang_id,
                'aksi' => 'Login',
                'tanggal_aksi' => now(),
                'keterangan' => "Pengelola gudang {$pengelola->username} melakukan login"
            ]);

            return redirect('/dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'loginError' => 'Username atau password salah.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        // Catat aktivitas logout sebelum menghapus session
        if (session()->has('pengelola_gudang_id')) {
            LogAktivitas::create([
                'username_id' => session('pengelola_gudang_id'),
                'aksi' => 'Logout',
                'tanggal_aksi' => now(),
                'keterangan' => "Pengelola gudang melakukan logout"
            ]);
        }

        // Hapus semua session
        session()->flush();

        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }

    // Tambahan method untuk middleware check
    public function checkSession()
    {
        if (!session()->has('pengelola_gudang_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return redirect()->back();
    }
}
