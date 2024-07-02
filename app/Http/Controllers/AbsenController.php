<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Pertemuan;
use App\Models\Rombel;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        $absen = Pertemuan::all();
        // $absen = Absen::with('pertemuan')->get();


        // $absen = Rombel::all();
        return view('backend.bk.absen', compact('absen'));
    }


    public function absen($id)
    {
        $data = Rombel::with('pertemuan', 'kelas.trx_siswa.siswa')->findOrFail($id);
        $siswa = Siswa::all();
        $dp = Pertemuan::find($id);

        $jumlahPertemuan = $dp->pertemuanKe;
        $per = [];

        for ($i = 1; $i <= $jumlahPertemuan; $i++) {
            $per[] = "p$i";
        }


        $kehadiranSiswa = [];
        $absenSiswa = [];

        foreach ($data->kelas->trx_siswa as $trx) {
            $absensi = Absen::where('id_trx_rombel_siswa', $trx->id_trx_rombel_siswa)
                ->where('id_pertemuan', $dp->id_pertemuan)
                ->get();
            $totalHadir = 0;
            $totalIzin = 0;
            $totalSakit = 0;
            $totalAlpa = 0;
            $totalBolos = 0;

            foreach ($absensi as $absen) {
                $keterangan = $absen->keterangan ?? '-';
                $pertemuan = $absen->pertemuan;
                $absenSiswa[$trx->id_trx_rombel_siswa][$absen->pertemuan] = $keterangan;
                if (!isset($absenSiswa[$trx->id_trx_rombel_siswa])) {
                    $absenSiswa[$trx->id_trx_rombel_siswa] = [];
                }

                $absenSiswa[$trx->id_trx_rombel_siswa][$pertemuan] = $keterangan;
                if ($keterangan == 'H') {
                    $totalHadir++;
                } elseif ($keterangan == 'I') {
                    $totalIzin++;
                } elseif ($keterangan == 'S') {
                    $totalSakit++;
                } elseif ($keterangan == 'A') {
                    $totalAlpa++;
                } elseif ($keterangan == 'B') {
                    $totalBolos++;
                }
            }
            $kehadiranSiswa[$trx->id_trx_rombel_siswa] = [
                'total_hadir' => $totalHadir,
                'total_izin' => $totalIzin,
                'total_sakit' => $totalSakit,
                'total_alpa' => $totalAlpa,
                'total_bolos' => $totalBolos,
            ];
        }


        return view('backend.bk.absenSiswa', compact('dp', 'absenSiswa', 'siswa', 'data', 'jumlahPertemuan', 'per', 'kehadiranSiswa'));
    }

    public function SimpanAbsen(Request $request, $id, $id_pertemuan)
    {
        $semester = Pertemuan::findOrFail($id);
        $data = [];

        foreach ($request->all() as $key => $value) {
            if ($key !== '_token') {
                foreach ($value as $k => $v) {
                    if ($v !== null) {
                        $data[] = [
                            'id_trx_rombel_siswa' => $k,
                            'keterangan' => $v,
                            'id_pertemuan' => $id_pertemuan,
                            'id_semester' => $semester->id_semester,
                            'pertemuan' => $key
                        ];
                    }
                }
                // dd($data);
            }
        }
        try {
            Absen::insert($data);
            return redirect()->route('kelola_absen', $semester->id_pertemuan)->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Throwable $e) {

            dd($e->getMessage());
        }
    }
    public function rekapAbsen($id)
    {
        $data = Rombel::with('pertemuan', 'kelas.trx_siswa.siswa')->findOrFail($id);
        $siswa = Siswa::all();
        $dp = Pertemuan::find($id);

        $jumlahPertemuan = $dp->pertemuanKe;
        $per = [];

        for ($i = 1; $i <= $jumlahPertemuan; $i++) {
            $per[] = "p$i";
        }


        $kehadiranSiswa = [];
        $absenSiswa = [];

        foreach ($data->kelas->trx_siswa as $trx) {
            $absensi = Absen::where('id_trx_rombel_siswa', $trx->id_trx_rombel_siswa)
                ->where('id_pertemuan', $dp->id_pertemuan)
                ->get();
            $totalHadir = 0;
            $totalIzin = 0;
            $totalSakit = 0;
            $totalAlpa = 0;
            $totalBolos = 0;

            foreach ($absensi as $absen) {
                $keterangan = $absen->keterangan ?? '-';
                $pertemuan = $absen->pertemuan;
                $absenSiswa[$trx->id_trx_rombel_siswa][$absen->pertemuan] = $keterangan;
                if (!isset($absenSiswa[$trx->id_trx_rombel_siswa])) {
                    $absenSiswa[$trx->id_trx_rombel_siswa] = [];
                }

                $absenSiswa[$trx->id_trx_rombel_siswa][$pertemuan] = $keterangan;
                if ($keterangan == 'H') {
                    $totalHadir++;
                } elseif ($keterangan == 'I') {
                    $totalIzin++;
                } elseif ($keterangan == 'S') {
                    $totalSakit++;
                } elseif ($keterangan == 'A') {
                    $totalAlpa++;
                } elseif ($keterangan == 'B') {
                    $totalBolos++;
                }
            }
            $kehadiranSiswa[$trx->id_trx_rombel_siswa] = [
                'total_hadir' => $totalHadir,
                'total_izin' => $totalIzin,
                'total_sakit' => $totalSakit,
                'total_alpa' => $totalAlpa,
                'total_bolos' => $totalBolos,
            ];
        }


        return view('backend.bk.rekapAbsen', compact('dp', 'absenSiswa', 'siswa', 'data', 'jumlahPertemuan', 'per', 'kehadiranSiswa'));
    }
    public function downloadRekapAbsenPDF($id)
    {
        $data = Rombel::with('pertemuan', 'trx.siswa')->findOrFail($id);
        $siswa = Siswa::all();
        $dp = Pertemuan::find($id);

        $jumlahPertemuan = $dp->pertemuanKe;
        $per = [];

        for ($i = 1; $i <= $jumlahPertemuan; $i++) {
            $per[] = "p$i";
        }

        $kehadiranSiswa = [];
        $absenSiswa = [];

        foreach ($data->trx as $trx) {
            $absensi = Absen::where('id_trx_rombel_siswa', $trx->id_trx_rombel_siswa)
                ->where('id_pertemuan', $dp->id_pertemuan)
                ->get();
            $totalHadir = 0;
            $totalIzin = 0;
            $totalSakit = 0;
            $totalAlpa = 0;
            $totalBolos = 0;

            foreach ($absensi as $absen) {
                $keterangan = $absen->keterangan ?? '-';
                $pertemuan = $absen->pertemuan;
                $absenSiswa[$trx->id_trx_rombel_siswa][$absen->pertemuan] = $keterangan;
                if (!isset($absenSiswa[$trx->id_trx_rombel_siswa])) {
                    $absenSiswa[$trx->id_trx_rombel_siswa] = [];
                }

                $absenSiswa[$trx->id_trx_rombel_siswa][$pertemuan] = $keterangan;
                if ($keterangan == 'H') {
                    $totalHadir++;
                } elseif ($keterangan == 'I') {
                    $totalIzin++;
                } elseif ($keterangan == 'S') {
                    $totalSakit++;
                } elseif ($keterangan == 'A') {
                    $totalAlpa++;
                } elseif ($keterangan == 'B') {
                    $totalBolos++;
                }
            }
            $kehadiranSiswa[$trx->id_trx_rombel_siswa] = [
                'total_hadir' => $totalHadir,
                'total_izin' => $totalIzin,
                'total_sakit' => $totalSakit,
                'total_alpa' => $totalAlpa,
                'total_bolos' => $totalBolos,
            ];
        }

        $pdf = FacadePdf::loadView('backend.bk.rekapAbsenPDF', compact('dp', 'absenSiswa', 'siswa', 'data', 'jumlahPertemuan', 'per', 'kehadiranSiswa'));
        return $pdf->download('rekap-absen.pdf');
    }
}
