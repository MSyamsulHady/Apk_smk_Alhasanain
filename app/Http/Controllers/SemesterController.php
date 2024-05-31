<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $semester = Semester::all();
        return view('backend.bk.semester', compact('semester'));
    }
    public function insertSemester(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'tahun_ajaran' => 'required',
            'nama_semester' => 'required',
            'status' => 'required'
        ]);
        try {
            $data = new Semester();
            $data->tahun_ajaran = $request->tahun_ajaran;
            $data->nama_semester = $request->nama_semester;
            $data->status = $request->status;
            $data->save();
            return redirect('semester')->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Exception $e) {
            // return redirect('semester')->with(['msg' => 'Data Gagal Disimpan', 'type' => 'error']);
            print($e);
        }
    }
    public function updateSemester(Request $request, $id)
    {
        $this->validate($request, [
            'tahun_ajaran' => 'required',
            'nama_semester' => 'required',
            'status' => 'required'
        ]);
        try {
            $data = Semester::find($id);
            $data->tahun_ajaran = $request->tahun_ajaran;
            $data->nama_semester = $request->nama_semester;
            $data->status = $request->status;
            $data->save();
            return redirect('semester')->with(['msg' => 'Data Berhasil DiUbah', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect('semester')->with(['msg' => 'Data Gagal DiUbah', 'type' => 'error']);
        }
    }
}
