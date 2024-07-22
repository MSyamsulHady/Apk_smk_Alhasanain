<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Rombel;
use App\Models\Semester;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RombelController extends Controller


{
    public function index()
    {
        // Ambil data semua pelajaran, kelas, dan guru
        $mapel = Pelajaran::all();
        $kelas = Kelas::all();
        $guru = Guru::all();

        // Ambil semester yang aktif
        $activeSemester = Semester::where('status', 'Aktif')->first();

        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester yang aktif.');
        }

        // Ambil data rombel yang terkait dengan semester aktif
        $data = Rombel::whereHas('kelas', function ($query) use ($activeSemester) {
            $query->where('id_semester', $activeSemester->id_semester);
        })->with('kelas', 'guru', 'mapel')->get();

        // Tampilkan view dengan data yang sudah dipersiapkan
        return view('backend.bk.rombel', compact('data', 'mapel', 'kelas', 'guru', 'activeSemester'));
    }
    public function addRombel(Request $request)
    {
        $request->validate([
            'id_mapel' => 'required|exists:pelajaran,id_mapel',
            'id_guru' => 'required|exists:guru,id_guru',
            'id_kelas' => 'required|exists:kelas,id_kelas',
        ]);

        $activeSemester = Semester::where('status', 'Aktif')->first();

        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester yang aktif.');
        }

        // Pastikan kelas yang dipilih termasuk dalam semester aktif
        $kelas = Kelas::where('id_kelas', $request->id_kelas)
            ->where('id_semester', $activeSemester->id_semester)
            ->first();

        if (!$kelas) {
            return redirect()->back()->with('error', 'Kelas yang dipilih tidak sesuai dengan semester aktif.');
        }

        $rombel = new Rombel();
        $rombel->id_mapel = $request->id_mapel;
        $rombel->id_guru = $request->id_guru;
        $rombel->id_kelas = $request->id_kelas;
        $rombel->save();


        return redirect('/rombel')->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
    }


    public function updtRombel(Request $request, $id)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_mapel' => 'required|exists:pelajaran,id_mapel',
            'id_guru' => 'required|exists:guru,id_guru',
        ]);

        try {
            // Ambil semester yang aktif
            $activeSemester = Semester::where('status', 'Aktif')->first();

            if (!$activeSemester) {
                return redirect()->back()->with('error', 'Tidak ada semester yang aktif.');
            }

            // Pastikan kelas yang dipilih termasuk dalam semester aktif
            $kelas = Kelas::where('id_kelas', $request->id_kelas)
                ->where('id_semester', $activeSemester->id_semester)
                ->first();


            if (!$kelas) {
                return redirect()->back()->with('error', 'Kelas yang dipilih tidak sesuai dengan semester aktif.');
            }


            // Temukan data Rombel berdasarkan ID dan update data
            $data = Rombel::findOrFail($id);
            $data->id_kelas = $request->id_kelas;
            $data->id_mapel = $request->id_mapel;
            $data->id_guru = $request->id_guru;
            $data->save();

            return redirect('/rombel')->with(['msg' => 'Data Berhasil Diubah', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function deleteRombel($id)
    {
        $data = Rombel::findOrFail($id);
        $data->delete();
        return redirect('/rombel')->with(['msg' => 'Data Berhasil Dihapus', 'type' => 'success']);
    }
}
