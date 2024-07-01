<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\Rombel;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        // group berdasarkan id kelas
        $rombel = Rombel::with('kelas')->select('id_kelas', DB::raw('count(id_mapel) as jml_mapel , min(id_rombel) as id_rombel'))->groupBy('id_kelas')->get();

        return view('backend.bk.nilai', compact('rombel'));
    }
    public function kelolaNilai($id_rombel)
    {
        // $model =  Rombel::find($id_rombel);
        $model = new Nilai();
        $mapel = Pelajaran::where('id');
        $data = $model->with('rombel', 'rombel.kelas', 'siswa')->where('id_rombel', $id_rombel)->get();


        $siswa = Siswa::all();
        return view('backend.bk.kelola_nilai', compact('model', 'mapel', 'data', 'siswa'));
    }
    public function InputNilai()
    {
    }
}
