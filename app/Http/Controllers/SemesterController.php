<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Contracts\Session\Session;
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
            if ($request->status == 'Aktif') {
                // Jika status yang dimasukkan adalah Aktif, ubah semua semester lain menjadi Tidak Aktif
                Semester::where('status', 'Aktif')->update(['status' => 'Tidak Aktif']);
            }
            $data = new Semester();
            $data->tahun_ajaran = $request->tahun_ajaran;
            $data->nama_semester = $request->nama_semester;
            $data->status = $request->status;
            $data->save();
            $request->session()->put('semester', $data);
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
            'status' => 'required|in:Aktif,Tidak Aktif', // Menambahkan validasi untuk status
        ]);

        try {
            $semester = Semester::findOrFail($id);

            // Jika status yang baru adalah Aktif, maka ubah semua semester lain menjadi Tidak Aktif
            if ($request->status == 'Aktif') {
                Semester::where('id_semester', '!=', $id)->update(['status' => 'Tidak Aktif']);
            }

            // Update semester yang sedang diedit
            $semester->tahun_ajaran = $request->tahun_ajaran;
            $semester->nama_semester = $request->nama_semester;
            $semester->status = $request->status;
            $semester->save();
            $request->session()->put('semester', $semester);

            return redirect('semester')->with(['msg' => 'Data Berhasil DiUbah', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect('semester')->with(['msg' => 'Data Gagal DiUbah', 'type' => 'error']);
        }
    }


    public function deleteSemester($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();
        return redirect('semester')->with(['msg' => 'Data Berhasil Dihapus', 'type' => 'success']);
    }
}
