<?php

namespace App\Http\Controllers;

use App\Models\KelasPelajaran;
use App\Models\Nilai;
use App\Models\Semester;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index($id)
    {
        $siswa = Siswa::all();
        $semester = Semester::all();
        $kelasPelajaran = KelasPelajaran::all();
        $data = Nilai::with('nilai.kelasPelajaran')->find($id);
        return view('backend.bk.nilai', compact('siswa', 'data', 'smester', 'kelasPelajaran'));
    }
}
