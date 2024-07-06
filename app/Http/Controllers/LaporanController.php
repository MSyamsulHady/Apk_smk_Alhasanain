<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\Rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $model = Rombel::with('kelas')->select('id_kelas', DB::raw('count(id_mapel) as jml_mapel , min(id_rombel) as id_rombel'))->groupBy('id_kelas')->get();
        return view('backend.bk.laporan', compact('model'));
    }
    public function Rekap($id)
    {
        $kelas = Kelas::with(['rombel.mapel', 'trx_siswa.siswa.nilai'])->findOrFail($id);
        $nilais = [];
        $jmlh_mapel = $kelas->rombel->count();
        // dd($jmlh_mapel);
        $colspan_mapel = $jmlh_mapel + 1;
        foreach ($kelas->trx_siswa as $siswa) {
            $nilais[$siswa->id_siswa] = $siswa->siswa->nilai->sum('nilai') / $jmlh_mapel;
        }

        return view('backend.bk.cetak_laporan', compact('kelas', 'colspan_mapel', 'nilais'));
    }
    public function cetakPdf($id)
    {
        $kelas = Kelas::with(['rombel.mapel', 'trx_siswa.siswa.nilai', 'semester'])->findOrFail($id);
        $nilais = [];
        $jmlh_mapel = $kelas->rombel->count();
        // dd($jmlh_mapel);
        $colspan_mapel = $jmlh_mapel + 1;
        foreach ($kelas->trx_siswa as $siswa) {
            $nilais[$siswa->id_siswa] = $siswa->siswa->nilai->sum('nilai') / $jmlh_mapel;
        }
        return view('backend.pdf.nilai', compact('kelas', 'colspan_mapel', 'nilais'));
    }
}
