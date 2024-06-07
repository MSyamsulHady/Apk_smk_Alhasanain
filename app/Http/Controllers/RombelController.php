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

        $mapel = Pelajaran::all();
        $kelas = Kelas::all();
        $guru = Guru::all();
<<<<<<< HEAD
        $data = Rombel::with('kelas', 'guru', 'mapel')->get();

=======
        $data = Rombel::with('trx_rombel_siswa', 'kelas', 'guru', 'mapel')->get();
>>>>>>> refs/remotes/origin/master
        return view('backend.bk.rombel', compact('data', 'mapel', 'kelas', 'guru'));
    }

    public function addRombel(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'id_guru' => 'required',
        ]);
        try {
            Rombel::create($request->all());
            return redirect('/rombel')->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updtRombel(Request $request, $id)
    {
        $request->validate([
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'id_guru' => 'required',

        ]);
        try {

            $data = Rombel::findOrFail($id);
            $data->id_kelas = $request->id_kelas;
            $data->id_mapel = $request->id_mapel;
            $data->id_guru = $request->id_guru;
            $data->save();
            return redirect('/rombel')->with(['msg' => 'Data Berhasil Diubah', 'type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function deleteRombel($id)
    {
        $data = Rombel::findOrFail($id);
        $data->delete();
        return redirect('/rombel')->with(['msg' => 'Data Berhasil Dihapus', 'type' => 'success']);
    }
}
