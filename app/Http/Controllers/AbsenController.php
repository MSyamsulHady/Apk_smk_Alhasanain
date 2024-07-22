<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Pertemuan;
use App\Models\Rombel;
use App\Models\Semester;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AbsenController extends Controller
{


    public function index()
    {
        // Ambil semester aktif
        $activeSemester = Semester::where('status', 'Aktif')->first();

        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester yang aktif.');
        }

        // Set locale ke bahasa Indonesia
        Carbon::setLocale('id');

        // Inisialisasi variabel absen
        $absen = collect();

        if (Auth::user()->role == 'Guru') {
            //  hari  bahasa Indonesia
            $currentDay = Carbon::now('Asia/Makassar')->isoFormat('dddd');

            // Ambil waktu sekarang di zona waktu Indonesia Tengah
            $currentTime = Carbon::now('Asia/Makassar')->toTimeString();

            // Ambil data absensi berdasarkan semester aktif, guru yang login, hari sekarang, dan waktu pertemuan belum selesai
            $absen = Pertemuan::whereHas('rombel.kelas', function ($query) use ($activeSemester) {
                $query->where('id_semester', $activeSemester->id_semester);
            })->whereHas('rombel', function ($query) {
                $query->where('id_guru', Auth::user()->id_guru);
            })->where('hari', $currentDay)
                ->where('mulai', '<=', $currentTime)
                ->where('selesai', '>', $currentTime)
                ->with(['absen', 'rombel.mapel', 'rombel.kelas'])
                ->get();
            // dd($absen);

            // Debugging: Cek jumlah data yang diambil
            if ($absen->isEmpty()) {
                session()->flash('msg', 'Jadwal Belum Ada');
                return redirect()->back();
            }
        } else {
            // Admin dapat melihat semua absen
            $absen = Pertemuan::whereHas('rombel.kelas', function ($query) use ($activeSemester) {
                $query->where('id_semester', $activeSemester->id_semester);
            })->with(['absen', 'rombel.mapel', 'rombel.kelas'])
                ->get();
            // dd($absen);
        }

        // Ambil semua model rombel untuk admin dan guru
        $model = Rombel::whereHas('kelas', function ($query) use ($activeSemester) {
            $query->where('id_semester', $activeSemester->id_semester);
        })->with('kelas', 'guru', 'mapel')
            ->get();

        return view('backend.bk.absen', compact('absen', 'model'));
    }




    public function absen($id_rombel, $id_pertemuan)
    {
        // Ambil rombel dan data yang diperlukan
        $data = Rombel::with('pertemuan', 'kelas.trx_siswa.siswa')->findOrFail($id_rombel);
        $siswa = Siswa::all();

        // Ambil pertemuan berdasarkan id_pertemuan
        $dp = Pertemuan::where('id_pertemuan', $id_pertemuan)->first();

        if (!$dp) {
            return redirect()->back()->with('sweet_alert', 'Pertemuan tidak ditemukan.');
        }
        $jumlahPertemuan = $dp->pertemuanKe;
        $per = [];

        for ($i = 1; $i <= $jumlahPertemuan; $i++) {
            $per[] = "p$i";
        }

        // Ambil semua pertemuan dengan id_rombel yang sama
        $pertemuanLain = Pertemuan::where('id_rombel', $id_rombel)
            ->where('id_pertemuan', '<>', $id_pertemuan)
            ->get();

        // Ambil absensi untuk semua pertemuan dengan id_rombel yang sama
        $absensi = Absen::whereIn('id_pertemuan', $pertemuanLain->pluck('id_pertemuan')->toArray())
            ->orWhere('id_pertemuan', $id_pertemuan)
            ->get();

        // Menyusun data absensi untuk tampilan
        $kehadiranSiswa = [];
        $absenSiswa = [];

        foreach ($data->kelas->trx_siswa as $trx) {
            $totalHadir = 0;
            $totalIzin = 0;
            $totalSakit = 0;
            $totalAlpa = 0;
            $totalBolos = 0;

            foreach ($absensi as $absen) {
                if ($absen->id_trx_rombel_siswa == $trx->id_trx_rombel_siswa) {
                    $keterangan = $absen->keterangan ?? '-';
                    $pertemuan = $absen->pertemuan;

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
            }

            $kehadiranSiswa[$trx->id_trx_rombel_siswa] = [
                'total_hadir' => $totalHadir,
                'total_izin' => $totalIzin,
                'total_sakit' => $totalSakit,
                'total_alpa' => $totalAlpa,
                'total_bolos' => $totalBolos,
            ];
        }

        return view('backend.bk.absenSiswa', compact('jumlahPertemuan', 'per', 'dp', 'absenSiswa', 'siswa', 'data', 'kehadiranSiswa'));
    }




    public function SimpanAbsen(Request $request, $id, $id_pertemuan)
    {
        $semester = Pertemuan::findOrFail($id_pertemuan);
        $userRole = Auth::user()->role;
        $data = [];
        $today = now()->toDateString(); // Tanggal hari ini

        // Pengecekan jika role adalah guru dan sudah ada data absensi untuk pertemuan ini
        if ($userRole == 'Guru') {
            $existingAbsenForGuru = Absen::where('id_pertemuan', $id_pertemuan)
                ->whereDate('tanggal', $today)
                ->exists();

            if ($existingAbsenForGuru) {
                return redirect()->route('kelola_absen', ['id_rombel' => $id, 'id_pertemuan' => $id_pertemuan])
                    ->with(['msg' => 'Absen sudah diisi pada pertemuan ini.', 'type' => 'danger']);
            }
        }

        foreach ($request->except('_token') as $pertemuan => $values) {
            foreach ($values as $id_trx_rombel_siswa => $keterangan) {
                if ($keterangan !== null) {
                    // Cek apakah sudah ada absensi untuk siswa ini pada pertemuan yang sama
                    $existingAbsen = Absen::where([
                        'id_trx_rombel_siswa' => $id_trx_rombel_siswa,
                        'id_pertemuan' => $id_pertemuan,
                        'pertemuan' => $pertemuan,
                        'tanggal' => $today
                    ])->first();

                    if ($existingAbsen) {
                        // Update jika data sudah ada
                        $existingAbsen->keterangan = $keterangan;
                        $existingAbsen->id_semester = $semester->id_semester;
                        $existingAbsen->tanggal = $today; // Menyimpan tanggal saat ini
                        $existingAbsen->save();
                    } else {
                        // Insert jika data belum ada
                        $data[] = [
                            'id_trx_rombel_siswa' => $id_trx_rombel_siswa,
                            'keterangan' => $keterangan,
                            'id_pertemuan' => $id_pertemuan,
                            'id_semester' => $semester->id_semester,
                            'pertemuan' => $pertemuan,
                            'tanggal' => $today, // Menyimpan tanggal saat ini
                        ];
                    }
                }
            }
        }

        try {
            if (!empty($data)) {
                Absen::insert($data);
            }

            return redirect()->route('kelola_absen', ['id_rombel' => $id, 'id_pertemuan' => $id_pertemuan])->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }









    public function rekapAbsen($id_rombel, $id_pertemuan)
    {
        // Ambil rombel dan data yang diperlukan
        $data = Rombel::with('pertemuan', 'kelas.trx_siswa.siswa')->findOrFail($id_rombel);
        $siswa = Siswa::all();

        // Ambil pertemuan berdasarkan id_pertemuan
        $dp = Pertemuan::where('id_pertemuan', $id_pertemuan)->first();

        if (!$dp) {
            return redirect()->back()->with('sweet_alert', 'Pertemuan tidak ditemukan.');
        }
        $jumlahPertemuan = $dp->pertemuanKe;
        $per = [];

        for ($i = 1; $i <= $jumlahPertemuan; $i++) {
            $per[] = "p$i";
        }

        // Ambil semua pertemuan dengan id_rombel yang sama
        $pertemuanLain = Pertemuan::where('id_rombel', $id_rombel)
            ->where('id_pertemuan', '<>', $id_pertemuan)
            ->get();

        // Ambil absensi untuk semua pertemuan dengan id_rombel yang sama
        $absensi = Absen::whereIn('id_pertemuan', $pertemuanLain->pluck('id_pertemuan')->toArray())
            ->orWhere('id_pertemuan', $id_pertemuan)
            ->get();

        // Menyusun data absensi untuk tampilan
        $kehadiranSiswa = [];
        $absenSiswa = [];

        foreach ($data->kelas->trx_siswa as $trx) {
            $totalHadir = 0;
            $totalIzin = 0;
            $totalSakit = 0;
            $totalAlpa = 0;
            $totalBolos = 0;

            foreach ($absensi as $absen) {
                if ($absen->id_trx_rombel_siswa == $trx->id_trx_rombel_siswa) {
                    $keterangan = $absen->keterangan ?? '-';
                    $pertemuan = $absen->pertemuan;

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
