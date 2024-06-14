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


        $absen = Rombel::all();
        return view('backend.bk.absen', compact('absen'));
    }


    public function absen($id)
    {
        $model = new Rombel();
        $data = $model->with('pertemuan.absen', 'mapel', 'trx.siswa', 'kelas.semester')->findOrFail($id);
        $siswa = Siswa::all();


        $absenSiswa = collect([]);

        $modelAbsen = new Absen();

        foreach ($data->trx as $key) {
            $absenSiswa[$key->id_trx_rombel_siswa] = [
                'nama' => $key->siswa->nama,
                'nis' => $key->siswa->nis,
                'jk' => $key->siswa->gender,
                'absen' => $modelAbsen->where([
                    'id_semester' => $data->kelas->semester->id_semester,
                    'id_trx_rombel_siswa' => $key->id_trx_rombel_siswa
                ])->get()
            ];
        }
        return view('backend.bk.absenSiswa', compact('absenSiswa', 'siswa', 'data'));
    }

    public function addAbsen($id_rombel, $id_pertemuan)
    {
        $model = new Rombel();
        $data = $model->with(['pertemuan.absen', 'mapel', 'trx.siswa', 'kelas.semester'])->findOrFail($id_rombel);

        return view('backend.bk.insertAbsen', compact('data', 'id_pertemuan'));
    }

    public function SimpanAbsen(Request $request, $id)
    {
        $request->validate(
            [
                'id_siswa' => 'required|array',
                'keterangan' => 'required|array'
            ]
        );
        $rombel = Rombel::findOrFail($id);
        $semester = Pertemuan::findOrFail($id)->id_semester;
        $data = [];


        foreach ($request->id_siswa as  $value) {
            $data[] = [
                'id_trx_rombel_siswa' => $value,
                'keterangan' => $request->keterangan[$value],
                'id_pertemuan' => $id,
                'id_semester' => $semester
            ];
        }


        try {
            Absen::insert($data);
            return redirect('')->route('kelola_absen', [
                $rombel->id_rombel,

            ])->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}
