<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\Pertemuan;
use App\Models\Rombel;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TrxRombel_siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{


    public function index()
    {

        $user = User::all();
        $use = Auth::user();

        return view('backend.auth.data_user', compact('user', 'use'));
    }


    // login
    public function login()
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('dashboard');
                    break;
                case 'Guru':
                    return redirect()->intended('dashboard');
                    break;
                default:
                    return redirect()->intended('login');
                    break;
            }
        }
        return view('backend.auth.login');
    }



    // Metode lain
    public function prosesLogin(Request $request)
    {
        $semesterAactive = Semester::where('status', 'Aktif')->first();


        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('semester', $semesterAactive);
            // Ambil user yang berhasil login
            $user = Auth::user();

            // Logging
            Log::info('User logged in', ['username' => $user->username]);
            return redirect()->route('dashboard')->with(['msg' => 'welcome to Aplikasi', 'type' => 'success']);
        } else {
            return redirect()->back()->withErrors([
                'username' => 'Username atau Password Salah.',
            ])->withInput($request->except('password'));
        }
    }






    //logout

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with(['msg' => 'berhasil LogOut', 'type' => 'success']);
    }

    public function dashboard()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        $jumlahMapel = Pelajaran::count();
        $jumlahAbsensi = Pertemuan::count();
        $jumlahKelas = Kelas::count();
        $jmlhNilai = Rombel::count();
        $semester = Semester::all();
    


        return view('backend.dashboard', compact('jumlahSiswa', 'jumlahGuru', 'jumlahAbsensi', 'jumlahKelas', 'jumlahMapel', 'jmlhNilai'));
    }
}
