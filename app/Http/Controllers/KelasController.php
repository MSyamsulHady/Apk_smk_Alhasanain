<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        $semester = Semester::all();

        $sesi = session()->get('id_semester');

        $kelas = Kelas::with('guru', 'semester')->where('id_semester', $sesi)->get();
        // dd($kelas);
        return view('backend.bk.kelas', compact('guru', 'semester', 'kelas'));
    }
    public function insertKelas(Request $request)
    {
        $this->validate($request, [
            'id_guru' => 'required',
            'nama_kelas' => 'required',
            'id_semester' => 'required',
            'ruangan' => 'required'
        ]);
        try {
            $data = new Kelas();
            $data->id_guru = $request->id_guru;
            $data->nama_kelas = $request->nama_kelas;
            $data->id_semester = $request->id_semester;
            $data->ruangan = $request->ruangan;
            $data->save();
            return redirect('/kelas')->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Exception $e) {
        }
    }
    public function updateKelas(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'id_guru' => 'required',
            'nama_kelas' => 'required',
            'id_semester' => 'required',
            'ruangan' => 'required'
        ]);
        try {
            $data = Kelas::findOrFail($id);
            $data->id_guru = $request->id_guru;
            $data->nama_kelas = $request->nama_kelas;
            $data->id_semester = $request->id_semester;
            $data->ruangan = $request->ruangan;
            $data->save();
            return redirect('/kelas')->with(['msg' => 'Data Berhasil Diubah', 'type' => 'success']);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
