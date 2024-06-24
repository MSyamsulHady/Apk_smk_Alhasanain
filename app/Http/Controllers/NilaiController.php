<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $rombel = Rombel::all();
        return view('backend.bk.nilai', compact('rombel'));
    }
    public function kelolaNilai($id)
    {
        $model = new Rombel();
        $data = $model->with('mapel', 'trx.siswa', 'kelas.semester')->findOrFail($id);
        $siswa = Siswa::all();
        return view('backend.bk.kelola_nilai', compact('model', 'data', 'siswa'));
    }
}
