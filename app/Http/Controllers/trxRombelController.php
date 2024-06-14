<?php

namespace App\Http\Controllers;

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
        $mapel = Rombel::with('mapel')->get();
        $rombel = Rombel::with('trx.siswa')->find($id);
        return view('backend.bk.trxRombel', compact('siswa', 'mapel', 'rombel'));
    }
    public function addPeserta(Request $request, $id)
    {
        // if (!empty($request->input('id_siswa'))) {

        //     // $will_insert = [];
        //     // foreach ($request->input('id_siswa') as $key => $value) {
        //     //     array_push($will_insert, ['id_siswa' => $value]);
        //     // }
        //     // DB::table('trx_rombel_siswas')->insert($will_insert);
        //     // dd($will_insert);
        // } else {
        //     $checkbox = '';
        // }
        $request->validate([
            'id_siswa' => 'required|array',
        ]);
        try {
            $data = [];
            foreach ($request->id_siswa as $key) {
                $data[] = ['id_siswa' => $key, 'id_rombel' => $id];
            }
            TrxRombel_siswa::insert($data);
            return back()->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Exception $e) {
            return abort('404');
        }
    }
}
