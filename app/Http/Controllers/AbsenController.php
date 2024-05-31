<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Guru;
use App\Models\KelasPelajaran;
use App\Models\Pelajaran;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        $kelasPelajaran = KelasPelajaran::all();
        $absen = Absen::all();

        return view('backend.bk.absen', compact('absen', 'kelasPelajaran'));
    }

    public function kelasAbsen($id_kelas)
    {
        $absen = Absen::whereHas('kelasPelajaran', function ($query) use ($id_kelas) {
            $query->whereHas('kelas', function ($query) use ($id_kelas) {
                $query->where('id_kelas', $id_kelas);
            });
        })->get();

        return view('backend.bk.absenSiswa', compact('absen'));
    }

    public function getGuru($id)
    {
        $kelasPelajaran = KelasPelajaran::with('guru')->find($id);

        if ($kelasPelajaran && $kelasPelajaran->guru) {
            return response()->json([
                'status' => 'success',
                'nama' => $kelasPelajaran->guru->nama,
                'id_guru' => $kelasPelajaran->guru->id_guru,
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Guru tidak ditemukan'], 404);
    }
    public function addAbsen(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id_kelas',
            'pelajaran_id' => 'required|exists:pelajaran,id_pelajaran',
            'guru_id' => 'required|exists:guru,id_guru',

        ]);

        // Mencari atau membuat entri di tabel kelas_pelajaran
        $kelasPelajaran = KelasPelajaran::firstOrCreate(
            [
                'id_kelas' => $request->kelas_id,
                'id_pelajaran' => $request->pelajaran_id,
                'id_guru' => $request->guru_id
            ]
        );

        // Menyimpan data absen baru
        $absen = new Absen;
        $absen->id_kelas_pelajaran = $kelasPelajaran->id_kelas_pelajaran;

        $absen->save();

        return redirect('/absen')->with('success', 'Data absen berhasil disimpan');
    }












    // public function kelola_absen()
    // {

    //     $absens = Absen::all();
    //     // $this->validate($requestuest, [
    //     //     'keterangan' => 'required',
    //     //     'tanggal_absen' => 'required',
    //     // ]);
    //     // try {

    //     //     $data = new Absen();
    //     //     $data->keterangan = $request->keterangan;
    //     //     $data->tanggal_absen = $request->tanggal_absen;
    //     //     $data->save();
    //     //     return redirect('dataguru')->with(['msg' => 'Data Berhasil Ditambah', 'type' => 'success']);
    //     // } catch (\Exception $e) {
    //     //     return redirect('dataguru')->with(['msg' => $e . 'Data Gagal Ditambah ', 'type' => 'error']);
    //     // }

    //     return view('backend.bk.kelola_absen', compact('absens'));
    // }
}
