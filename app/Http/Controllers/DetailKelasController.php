<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailKelasController extends Controller
{
    public function index($id_kelas)
    {
        $siswa  = Siswa::all();
        $kelas = Kelas::with('detail_kelas.siswa')->find($id_kelas);
        // dd($kelas);
        return view('backend.bk.detail_kelas', compact('kelas', 'siswa'));
    }



    public function insertdetail(Request $request)
    {
        $this->validate($request, [
            'id_siswa' => 'required|array'
        ]);
        // dd($request->all());

        try {

            if (!empty($request->input('id_siswa'))) {
                $insert = [];
                foreach ($request->input('id_siswa') as $key => $value) {
                    array_push($insert, ['id_kelas' => $request->id_kelas, 'id_siswa' => $value]);
                }
                DB::table('detail_kelas')->insert($insert);
            } else {
            }
            return back()->with(['msg' => 'Data Berhasil Ditambah', 'type' => 'success']);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
