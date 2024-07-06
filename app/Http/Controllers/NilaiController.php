<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\Rombel;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TrxRombel_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        // Ambil semester aktif
        $activeSemester = Semester::where('status', 'Aktif')->first();

        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester yang aktif.');
        }

        // Ambil data nilai berdasarkan semester aktif dan guru yang login
        if (Auth::user()->role == 'Guru') {
            $model = Rombel::whereHas('kelas', function ($query) use ($activeSemester) {
                $query->where('id_semester', $activeSemester->id_semester);
            })->where('id_guru', Auth::user()->id_guru)->with('kelas', 'mapel', 'nilai')->get();
        } else {
            $model = Rombel::whereHas('kelas', function ($query) use ($activeSemester) {
                $query->where('id_semester', $activeSemester->id_semester);
            })->with('kelas', 'mapel', 'nilai')->get();
        }

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
