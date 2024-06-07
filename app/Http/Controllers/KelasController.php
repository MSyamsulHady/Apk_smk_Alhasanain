<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Rombel;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {

        $semester = Semester::all();

        $sesi = session()->get('id_semester');

        $kelas = Kelas::with('semester')->where('id_semester', $sesi)->get();
        // dd($kelas);
        return view('backend.bk.kelas', compact('semester', 'kelas'));
    }
    public function insertKelas(Request $request)
    {
        $this->validate($request, [
            'nama_kelas' => 'required',
            'id_semester' => 'required',
        ]);
        try {
            $data = new Kelas();
            $data->nama_kelas = $request->nama_kelas;
            $data->id_semester = $request->id_semester;
            $data->save();
            return redirect('/kelas')->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Exception $e) {
        }
    }
    public function updateKelas(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'nama_kelas' => 'required',
            'id_semester' => 'required',
        ]);
        try {
            $data = Kelas::findOrFail($id);
            $data->nama_kelas = $request->nama_kelas;
            $data->id_semester = $request->id_semester;
            $data->save();
            return redirect('/kelas')->with(['msg' => 'Data Berhasil Diubah', 'type' => 'success']);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
