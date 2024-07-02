<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\TrxRombel_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        // group berdasarkan id kelas
        // $rombel = Rombel::with('kelas')->select('id_kelas', DB::raw('count(id_mapel) as jml_mapel , min(id_rombel) as id_rombel'))->groupBy('id_kelas')->get();
        $model = Rombel::with('kelas', 'mapel')->where('id_guru', Auth::user()->id_guru)->get();
        return view('backend.bk.nilai', compact('model'));
    }
    public function kelolaNilai($id_kelas)
    {
        $nilai = Nilai::where('id_kelas', $id_kelas)->get()->dd();

        $kelas =  Kelas::findOrFail($id_kelas)->rombel->groupBy('id_kelas');

        $model = new Nilai();
        $mapel = Pelajaran::where('id');
        // $data = $model->with('rombel', 'rombel.kelas', 'siswa')->where('id_rombel', $id_rombel)->get();
        $jmlh = $kelas->first()->count() + 1;

        $siswa = TrxRombel_siswa::with('siswa')->where('id_kelas', $id_kelas)->select('id_siswa')->groupBy('id_siswa')->get();
        return view('backend.bk.kelola_nilai', compact('model', 'mapel', 'siswa', 'kelas', 'jmlh'));
    }
    public function InputNilai(Request $req)
    {
        // $nilais = [];
        // foreach($req->all() as $key => $val){
        //     foreach($val as $nilai){
        //     if(!empty($nilai)){
        //         $nilais[]=
        //     }
        //     }
        // }
    }
}
