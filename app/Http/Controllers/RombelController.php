<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Rombel;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    public function index()
    {
        Rombel::with('trx_rombel_siswa')->get()->dd();
        $mapel = Pelajaran::all();
        $kelas = Kelas::all();
        $guru = Guru::all();
        $data = Rombel::all();
        return view('backend.bk.rombel', compact('data', 'mapel', 'kelas', 'guru'));
    }
}
