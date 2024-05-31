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
            'nama_mapel' => 'required',
            'id_guru' => 'required',
            'kurikulum' => 'required',
            'muatan' => 'required'

        ]);

        try {
            $data = new Pelajaran();
            $data->nama_mapel = $request->nama_mapel;
            $data->id_guru = $request->id_guru;
            $data->kurikulum = $request->kurikulum;
            $data->muatan = $request->muatan;
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
            'nama_mapel' => 'required',
            'id_guru' => 'required',
            'katagori' => 'required',
            'kurikulum' => 'required',

        ]);

        try {
            $data =  Pelajaran::find($id);
            $data->nama_mapel = $request->nama_mapel;
            $data->id_guru = $request->id_guru;
            $data->katagori = $request->katagori;
            $data->kurikulum = $request->kurikulum;
            $data->save();
            return redirect('mapel')->with(['msg' => 'Data Berhasil Diubah', 'type' => 'success']);
        } catch (\Exception $e) {
        }
    }
}
