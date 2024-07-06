<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\TrxRombel_siswa;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        // group berdasarkan id kelas
        // $rombel = Rombel::with('kelas')->select('id_kelas', DB::raw('count(id_mapel) as jml_mapel , min(id_rombel) as id_rombel'))->groupBy('id_kelas')->get();
        if (Auth::user()->role == 'Guru') {
            $model = Rombel::with('kelas', 'mapel', 'kelas.trx_siswa.siswa', 'nilai')->where('id_guru', Auth::user()->id_guru)->get();
        } else {

            $model = Rombel::with('kelas', 'mapel', 'kelas.trx_siswa.siswa')->get();
        }
        return view('backend.bk.nilai', compact('model'));
    }
    public function kelolaNilai($id)
    {
        $model = Rombel::with(['kelas.trx_siswa.siswa.nilai' => function ($q) use ($id) {
            $q->where('id_rombel', $id);
        }])->findOrFail($id);

        return view('backend.bk.detail_nilai', compact('model'));
    }
    public function InputNilai(Request $req, $id)
    {
        // dd($req->all());
        try {
            $nilais = [];
            foreach ($req->all() as $key => $val) {
                if ($key != "_token") {
                    $nilais[] = ['id_rombel' => $id, 'id_siswa' => $key, 'nilai' => $val];
                }
            }
            // dd($nilais);
            Nilai::insert($nilais);
            return back()->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Exception $e) {
            // return abort('404');
            return $e->getMessage();
        }
    }
}
