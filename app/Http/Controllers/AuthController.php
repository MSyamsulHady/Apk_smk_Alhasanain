<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        $user = User::all();
        $use = Auth::user();
        $semes = $user->semesters;
        return view('backend.auth.data_user', compact('user', 'use', 'semes'));
    }


    // login
    public function login()
    {
        $semester = Semester::all();


        if ($user =
            Auth::user()

        ) {
            if ($user->role == 'admin') {
                return redirect()->intended('dashboard');
            } elseif ($user->role == 'guru') {
                return redirect()->intended('dashboard');
            } elseif ($user->role == 'siswa') {
                return redirect()->intended('dashboard');
            } elseif ($user->role == 'kepsek') {
                return redirect()->intended('dashboard');
            } elseif ($user->role == 'wakasek') {
                return redirect()->intended('dashboard');
            } else {
                return redirect()->intended('login');
            }
        }
        return view('backend.auth.login', compact('semester'));
    }

    // proses login user
    public function prosesLogin(Request $request)
    {
        $semester = Semester::all();
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'id_semester' => 'required'
        ]);

        $kredensial = $request->only('username', 'password');
        $kredensial['id_semester'] = $request->tahun_ajaran;
        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            session()->put('id_semester', $request->id_semester);
            $user = Auth::user();
            $semester = $user->semester;
            if ($user->role == 'admin') {
                return redirect()->intended('dashboard')->with(['msg' => 'Login Berhasil.', 'type' => 'success']);
            } elseif ($user->role == 'siswa') {
                return redirect()->intended('dashboard')->with(['msg' => 'Login Berhasil.', 'type' => 'success']);
            } elseif ($user->role == 'guru') {
                return redirect()->intended('dashboard')->with(['msg' => 'Login Berhasil.', 'type' => 'success']);
            } else {
                return redirect()->intended('login');
            }
        } else {
            return  redirect()->back()->with(['msg' => 'Username atau Password Salah', 'type' => 'error']);
        }
    }
    //logout

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
