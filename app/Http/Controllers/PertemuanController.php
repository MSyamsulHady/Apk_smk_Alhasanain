<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Pertemuan;
use App\Models\Rombel;
use App\Models\Semester;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PertemuanController extends Controller
{
    public function index()
    {

        //

        {
            // Atur locale ke bahasa Indonesia
            Carbon::setLocale('id');
            $date = Carbon::now();
            $dayName = $date->translatedFormat('l');

            // Ambil semester aktif dari session atau dari database
            $activeSemester = $this->getActiveSemester();

            if (!$activeSemester) {
                return redirect()->back()->with(['msg' => 'Tidak ada semester yang aktif.', 'type' => 'error']);
            }

            // Ambil data rombel dan jadwal berdasarkan semester aktif
            $semester = Semester::all();
            $rombel = Rombel::with('kelas', 'mapel', 'guru')
                ->whereHas('kelas.semester', function ($query) use ($activeSemester) {
                    $query->where('id_semester', $activeSemester->id_semester);
                })->get();

            $jadwal = Pertemuan::with('rombel')
                ->where('id_semester', $activeSemester->id_semester)
                ->get();

            return view('backend.bk.jadwal', compact('jadwal', 'rombel', 'semester', 'dayName'));
        }
    }

    // Metode untuk mendapatkan semester aktif dari database
    protected function getActiveSemester()
    {
        return Semester::where('status', 'Aktif')->first();
    }


    public function addPertemuan(Request $request)
    {
        try {
            Pertemuan::create($request->all());
            return redirect()->route('jadwal')->with(['msg' => 'Data Berhasil Disimpan', 'type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updatePertemuan(Request $request, $id)
    {
        $pertemuan = Pertemuan::findOrFail($id);

        // Update the fields of the Pertemuan record
        $pertemuan->id_rombel = $request->id_rombel;
        $pertemuan->id_semester = $request->id_semester;
        $pertemuan->pertemuanKe = $request->pertemuanKe;
        $pertemuan->hari = $request->hari;
        $pertemuan->mulai = $request->mulai;
        $pertemuan->selesai = $request->selesai;

        try {
            // Save the changes
            $pertemuan->save();
            return redirect()->route('jadwal')->with(['msg' => 'Data Berhasil Diperbarui', 'type' => 'success']);
        } catch (\Throwable $e) {
            // Log the error message
            Log::error('Error updating pertemuan: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with(['msg' => 'Data Gagal Diperbarui', 'type' => 'danger']);
        }
    }


    public function deletePertemuan($id)
    {

        $pertemuan = Pertemuan::findOrFail($id);
        $pertemuan->delete();
        return redirect()->route('jadwal')->with(['msg' => 'Data Berhasil DiHapus', 'type' => 'success']);
    }
}
