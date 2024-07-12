<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\Rombel;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TrxRombel_siswa;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        // Ambil semester aktif
        $activeSemester = Semester::where('status', 'Aktif')->first();

        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester yang aktif.');
        }

        // Ambil data nilai berdasarkan semester aktif dan guru yang login
        if (Auth::user()->role == 'Guru') {
            $model = Rombel::whereHas('kelas', function ($query) use ($activeSemester) {
                $query->where('id_semester', $activeSemester->id_semester);
            })->where('id_guru', Auth::user()->id_guru)->with('kelas', 'mapel', 'nilai')->get();
        } else {
            $model = Rombel::whereHas('kelas', function ($query) use ($activeSemester) {
                $query->where('id_semester', $activeSemester->id_semester);
            })->with('kelas', 'mapel', 'nilai')->get();
        }

        return view('backend.bk.nilai', compact('model'));
    }
    public function kelolaNilai($id)
    {
        $model = Rombel::with(['kelas.trx_siswa.siswa.nilai' => function ($q) use ($id) {
            $q->where('id_rombel', $id);
        }])->findOrFail($id);

        return view('backend.bk.detail_nilai', compact('model'));
    }
    // public function InputNilai(Request $req, $id)
    // {
    //     // dd($req->all());
    //     try {
    //         $nilais = [];
    //         foreach ($req->all() as $key => $val) {
    //             if ($key != "_token") {
    //                 $nilais[] = ['id_rombel' => $id, 'id_siswa' => $key, 'nilai' => $val];
    //             }
    //         }
    //         // dd($nilais);
    //         Nilai::insert($nilais);
    //         return back()->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
    //     } catch (\Exception $e) {
    //         // return abort('404');
    //         return $e->getMessage();
    //     }
    // }
    public function InputNilai(Request $req, $id)
    {
        // Validasi data request jika diperlukan
        $req->validate([
            // 'key' => 'required|type', // Contoh validasi
        ]);

        try {
            // Array untuk menyimpan data nilai
            $nilais = [];

            // Iterasi semua data request
            foreach ($req->all() as $key => $val) {
                // Mengabaikan token CSRF
                if ($key != "_token") {
                    $nilais[] = [
                        'id_rombel' => $id,
                        'id_siswa' => $key,
                        'nilai' => $val,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }

            // Upsert data ke dalam tabel Nilai
            foreach ($nilais as $nilai) {
                Nilai::updateOrInsert(
                    [
                        'id_rombel' => $nilai['id_rombel'],
                        'id_siswa' => $nilai['id_siswa']
                    ],
                    [
                        'nilai' => $nilai['nilai'],
                        'updated_at' => $nilai['updated_at']
                    ]
                );
            }

            // Redirect dengan pesan sukses
            return back()->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Exception $e) {
            // Mengembalikan pesan error jika terjadi kesalahan
            return back()->with(['msg' => 'Terjadi kesalahan: ' . $e->getMessage(), 'type' => 'danger']);
        }
    }
}
