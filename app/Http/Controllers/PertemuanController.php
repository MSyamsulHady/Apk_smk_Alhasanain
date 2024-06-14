<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use App\Models\Rombel;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    public function addPertemuan(Request $request, $id)
    {
        $data = $request->validate([
            'pertemuanKe' => 'required',
            'tanggal_pertemuan' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            // dd($request)
        ]);

        $rombel = Rombel::findOrFail($id);

        $data['id_rombel'] = $id;
        $data['id_semester'] = $rombel->kelas->semester->id_semester;
        try {
            $pertemuan = Pertemuan::create($data);
            return redirect()->route('tambahAbsen', [
                $rombel->id_rombel,
                $pertemuan->id_pertemuan

            ])->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function updatePertemuan(Request $request, $id)
    {
        $data = $request->validate([
            'pertemuanKe' => 'required',
            'tanggal_pertemuan' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            // dd($request)
        ]);

        $rombel = Rombel::findOrFail($id);

        $data['id_rombel'] = $id;
        $data['id_semester'] = $rombel->kelas->semester->id_semester;
        try {
            $pertemuan = Pertemuan::updated($data);
            return redirect()->route('tambahAbsen', [
                $rombel->id_rombel,
                // $pertemuan->id_pertemuan

            ])->with(['msg' => 'Data Berhasil Diubah', 'type' => 'success']);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}
