<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasPelajaran;
use App\Models\Pelajaran;
use Illuminate\Http\Request;

class KelasPelajaranController extends Controller
{
    public function index()
    {
        $mapel = Pelajaran::all();
        $kelas = Kelas::all();
        $guru = Guru::all();
        $data = KelasPelajaran::with('mapel', 'kelas', 'guru')->get();
        return view('backend.bk.kelas_pelajaran', compact('data', 'mapel', 'kelas', 'guru'));
    }
    public function getGuru($id)
    {
        $guru = Pelajaran::with('guru')->find($id);
        return response()->json(['nama' => $guru]);
    }
    public function tambahK_pelajaran(Request $req)
    {
        $this->validate($req, [
            'id_mapel' => 'required',
            'id_guru' => 'required',
            'id_kelas' => 'required'
        ]);
        try {
            $data = new KelasPelajaran();
            $data->id_mapel = $req->id_mapel;
            $data->id_guru = $req->id_guru;
            $data->id_kelas = $req->id_kelas;
            $data->save();
            return redirect('rombel')->with(['msg' => 'Data Berhasil disimpan', 'type' => 'success']);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_mapel' => 'required',
            'id_guru' => 'required',
            'id_kelas' => 'required'
        ]);
        try {
            $data = KelasPelajaran::find($id);
            $data->id_mapel = $request->id_mapel;
            $data->id_guru = $request->id_guru;
            $data->id_kelas = $request->id_kelas;
            $data->save();
            return redirect('rombel')->with(['msg' => 'Data Berhasil Diubah', 'type' => 'success']);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
