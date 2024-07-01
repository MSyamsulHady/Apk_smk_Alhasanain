<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Pelajaran;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    public function index()
    {
        $guru = Guru::with('Pelajaran')->get();
        $pelajaran = Pelajaran::with('guru')->get();
        $title = 'pelajaran';
        return view('backend.bk.mata_pelajaran', compact('guru', 'pelajaran', 'title'));
    }

    public function ADDmapel(Request $request)
    {
        $this->validate($request, [
            'kode_mapel' => 'required',
            'nama_mapel' => 'required',

        ]);

        try {
            $data = new Pelajaran();
            $data->kode_mapel = $request->kode_mapel;
            $data->nama_mapel = $request->nama_mapel;
            $data->save();

            return redirect('mapel')->with(['msg' => 'Data Berhasil Ditambah', 'type' => 'success']);
        } catch (\Exception $e) {
            return $e;
        }
        // $data = Pelajaran::create($request->all());
        // return redirect('mapel')->with(['msg' => 'Data Berhasil Ditambah', 'type' => 'success']);
    }

    public function UPDmapel(Request $request, $id)
    {
        $this->validate($request, [
            'kode_mapel' => 'required',
            'nama_mapel' => 'required',

        ]);

        try {
            $data =  Pelajaran::find($id);
            $data->kode_mapel = $request->kode_mapel;
            $data->nama_mapel = $request->nama_mapel;
            $data->save();
            return redirect('mapel')->with(['msg' => 'Data Berhasil Diubah', 'type' => 'success']);
        } catch (\Exception $e) {
        }
    }

    public function deleteMapel($id)
    {
        $mapel = Pelajaran::findOrfail($id);
        $mapel->delete();
        return redirect('mapel')->with(['msg' => 'Data Berhasil Dihapus', 'type' => 'success']);
    }
}
