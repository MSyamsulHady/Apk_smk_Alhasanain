<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\TrxRombel_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class trxRombelController extends Controller
{
    public function index($id)
    {
        $siswa = Siswa::all();
        $model = Rombel::with('kelas.trx_siswa.siswa')->find($id);
        // dd($model);
        return view('backend.bk.trxRombel', compact('siswa', 'model'));
    }
    public function addPeserta(Request $request, $id)
    {

        $request->validate([
            'id_siswa' => 'required|array',
        ]);
        try {
            $data = [];
            // $model = new Kelas();
            foreach ($request->id_siswa as $key) {
                $data[] = ['id_kelas' => $id, 'id_siswa' => $key];
            }
            // dd($data);
            TrxRombel_siswa::insert($data);
            return back()->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Exception $e) {
            return abort('404');
        }
    }
}
