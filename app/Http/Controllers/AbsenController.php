<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasPelajaran;
use App\Models\Pelajaran;
use App\Models\Pertemuan;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\TrxRombel_siswa;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        // $pertemuan = Absen::with('pertemuan')->get()->dd(d);

        // $tr = TrxRombel_siswa::with('siswa')->get();
        // $kelas = Kelas::all();
        // $guru = Guru::all();
        // $mapel = Pelajaran::all();
        $absen = Absen::all();

        return view('backend.bk.absen', compact('absen'));
    }

    // public function kelasAbsen($id_kelas)
    // {
    //     $absen = Absen::whereHas('kelasPelajaran', function ($query) use ($id_kelas) {
    //         $query->whereHas('kelas', function ($query) use ($id_kelas) {
    //             $query->where('id_kelas', $id_kelas);
    //         });
    //     })->get();

    //     return view('backend.bk.absenSiswa', compact('absen'));
    // }

    // public function getGuru($id)
    // {
    //     $pertemuan = Pertemuan::with('rombel.guru')->find($id);

    //     if ($pertemuan && $pertemuan->rombel && $pertemuan->rombel->guru) {
    //         return response()->json([
    //             'status' => 'success',
    //             'nama' => $pertemuan->rombel->guru->nama,
    //             'id_guru' => $pertemuan->rombel->guru->id_guru,
    //         ]);
    //     }

    //     return response()->json(['status' => 'error', 'message' => 'Guru tidak ditemukan'], 404);
    // }
    public function AddAbsen(Request $request)
    {
        $request->validate([
            'pertemuan_id' => 'required|exists:pertemuan,id',
        ]);

        $pertemuan = Pertemuan::with('rombel.kelas', 'rombel.guru', 'rombel.mapel')->find($request->id_pertemuan);

        if ($pertemuan && $pertemuan->rombel) {
            Absen::create([
                'pertemuan_id' => $request->id_pertemuan,
                'nama_kelas' => $pertemuan->rombel->kelas->nama_kelas,
                'nama_mata_pelajaran' => $pertemuan->rombel->mapel->nama_mapel,
                'nama_guru' => $pertemuan->rombel->guru->nama,
            ]);

            return redirect()->route('absen.index')->with('success', 'Data absen berhasil ditambahkan');
        }

        return redirect()->route('absen.index')->with('error', 'Gagal menambahkan data absen');
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
