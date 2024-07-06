<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Pertemuan;
use App\Models\Semester;
use App\Models\Siswa;
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
            return redirect()->route('dashboard')->with('msg', 'Selamat Datang!');
            // Cek role user
            // switch ($user->role) {
            //     case 'Admin':
            //         $activeSemester = $this->getActiveSemester();

            //         // Logging
            //         Log::info('Active Semester', ['activeSemester' => $activeSemester ? $activeSemester->id_semester : 'No active semester found']);

            //         if ($activeSemester) {
            //             Session::put('active_semester', $activeSemester->id_semester);
            //             Session::put('tahun_ajaran', $activeSemester->tahun_ajaran);
            //             Session::put('nama_semester', $activeSemester->nama_semester);
            //             return redirect()->intended('dashboard')->with(['msg' => 'Login Berhasil.', 'type' => 'success']);
            //         } else {
            //             Auth::logout();
            //             return redirect()->back()->with(['msg' => 'Tidak ada semester yang aktif.', 'type' => 'error']);
            //         }
            //         break;

            //     case 'Guru':
            //         $activeSemester = $this->getActiveSemesterForUser($user);

            //         // Logging
            //         Log::info('Active Semester for Guru', ['activeSemester' => $activeSemester ? $activeSemester->id_semester : 'No active semester found for Guru']);

            //         if ($activeSemester) {
            //             Session::put('active_semester', $activeSemester->id_semester);
            //             Session::put('tahun_ajaran', $activeSemester->tahun_ajaran);
            //             Session::put('nama_semester', $activeSemester->nama_semester);
            //             return redirect()->intended('welcome')->with(['msg' => 'Login Berhasil.', 'type' => 'success']);
            //         } else {
            //             Auth::logout();
            //             return redirect()->back()->with(['msg' => 'Tidak ada semester yang aktif untuk tahun ajaran Anda.', 'type' => 'error']);
            //         }
            //         break;

            //     default:
            //         return redirect()->intended('login');
            //         break;
            // }
        }

        return redirect()->back()->with(['msg' => 'Username atau Password Salah', 'type' => 'error']);
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

        return view('backend.dashboard', compact('jumlahSiswa', 'jumlahGuru', 'jumlahAbsensi', 'jumlahKelas', 'jumlahMapel'));
    }
}
