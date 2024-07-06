<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Pertemuan;
use App\Models\Rombel;
use App\Models\Semester;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Siswa;
use App\Models\TrxRombel_siswa;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    public function index()
    {
        // Ambil semester aktif
        $activeSemester = Semester::where('status', 'Aktif')->first();

        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester yang aktif.');
        }

        // Ambil data absensi berdasarkan semester aktif dan guru yang login
        if (Auth::user()->role == 'Guru') {
            $absen = Pertemuan::whereHas('rombel.kelas', function ($query) use ($activeSemester) {
                $query->where('id_semester', $activeSemester->id_semester);
            })->whereHas('rombel', function ($query) {
                $query->where('id_guru', Auth::user()->id_guru);
            })->get();

            $model = Rombel::whereHas('kelas', function ($query) use ($activeSemester) {
                $query->where('id_semester', $activeSemester->id_semester);
            })->where('id_guru', Auth::user()->id_guru)->with('kelas', 'guru', 'mapel')->get();
        } else {
            $absen = Pertemuan::whereHas('rombel.kelas', function ($query) use ($activeSemester) {
                $query->where('id_semester', $activeSemester->id_semester);
            })->get();

            $model = Rombel::whereHas('kelas', function ($query) use ($activeSemester) {
                $query->where('id_semester', $activeSemester->id_semester);
            })->with('kelas', 'guru', 'mapel')->get();
        }

        return view('backend.bk.absen', compact('absen', 'model'));
    }



    public function absen($id)
    {
        $data = Rombel::with('pertemuan', 'kelas.trx_siswa.siswa')->findOrFail($id);
        $siswa = Siswa::all();
        $dp = Pertemuan::where('id_pertemuan', $data->pertemuan->id_pertemuan)->first();

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
        $semester = Pertemuan::findOrFail($id_pertemuan);
        $data = [];

        foreach ($request->except('_token') as $pertemuan => $values) {
            foreach ($values as $id_trx_rombel_siswa => $keterangan) {
                if ($keterangan !== null) {
                    $existingAbsen = Absen::where([
                        'id_trx_rombel_siswa' => $id_trx_rombel_siswa,
                        'id_pertemuan' => $id_pertemuan,
                        'pertemuan' => $pertemuan
                    ])->first();

                    if ($existingAbsen) {
                        // Update jika data sudah ada
                        $existingAbsen->keterangan = $keterangan;
                        $existingAbsen->id_semester = $semester->id_semester;
                        $existingAbsen->save();
                    } else {
                        // Insert jika data belum ada
                        $data[] = [
                            'id_trx_rombel_siswa' => $id_trx_rombel_siswa,
                            'keterangan' => $keterangan,
                            'id_pertemuan' => $id_pertemuan,
                            'id_semester' => $semester->id_semester,
                            'pertemuan' => $pertemuan
                        ];
                    }
                }
            }
        }

        try {
            if (!empty($data)) {
                Absen::insert($data);
            }

            return redirect()->route('kelola_absen', $id)->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }
    // public function updateAbsen(Request $request, $id, $id_pertemuan)
    // {
    //     $semester = Pertemuan::findOrFail($id_pertemuan);

    //     DB::beginTransaction();
    //     try {
    //         foreach ($request->all() as $key => $value) {
    //             if ($key !== '_token') {
    //                 foreach ($value as $k => $v) {
    //                     if ($v !== null) {
    //                         Absen::where('id_trx_rombel_siswa', $k)
    //                             ->where('id_pertemuan', $id_pertemuan)
    //                             ->update([
    //                                 'keterangan' => $v,
    //                                 'id_semester' => $semester->id_semester,
    //                                 'pertemuan' => $key
    //                             ]);
    //                     }
    //                 }
    //             }
    //         }

    //         DB::commit();
    //         return redirect()->route('kelola_absen', $id)->with(['msg' => 'Data Berhasil Diperbarui', 'type' => 'success']);
    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         dd($e->getMessage());
    //     }
    // }

    public function rekapAbsen($id)
    {
        $data = Rombel::with('pertemuan', 'kelas.trx_siswa.siswa')->findOrFail($id);
        $siswa = Siswa::all();
        $dp = Pertemuan::where('id_pertemuan', $data->pertemuan->id_pertemuan)->first();

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
}
