<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AllDataSiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DetailKelasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasPelajaranController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\rombel_kelasController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\SanksiController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TataTertibController;
use App\Http\Controllers\trxRombelController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::controller(LandingController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/bk', 'bk')->name('bimbingan_konseling');
    Route::get('/pendaftaran', 'pendaftaran')->name('pendaftaran');
    Route::get('/prestasi', 'prestasi')->name('prestasi');
    Route::get('/kegiatan', 'kegiatan')->name('kegiatan');
});
// Route::get('/dashboard', function () {
//     return view('backend.dashboard');
// })->name('dashboard')->middleware('auth');

Route::get('/profile', function () {
    return view('backend.profile');
})->name('profile');

Route::controller(AuthController::class)->group(function () {
    Route::get('DataUser', 'index')->name('datauser');
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('prosesLogin', 'proseslogin')->name('proseslogin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});
Route::controller(PelajaranController::class)->group(function () {
    Route::get('/mapel', 'index')->name('mapel')->middleware('auth');
    Route::post('/mapel/insert', 'ADDmapel')->name('mapelinsert')->middleware('auth');
    Route::put('/mapel/update/{id}', 'UPDmapel')->name('updatemapel')->middleware('auth');
    Route::delete('/deleteMapel/{id}', 'deleteMapel')->name('deleteMapel')->middleware('auth');
});
Route::controller(SiswaController::class)->group(function () {
    Route::get('/datasiswa', 'index')->name('datasiswa')->middleware('auth');
    Route::post('/datasiswa/insert_siswa', 'tambahSiswa')->name('insert_siswa')->middleware('auth');
    Route::put('/datasiswa/update/{id}', 'editsiswa')->name('update_siswa')->middleware('auth');
    Route::delete('/datasiswa/delete/{id}', 'deletesiswa')->name('delete_siswa')->middleware('auth');
    Route::get('showSiswa', 'siswaShow')->name('showSiswa')->name('showSiswa')->middleware('auth');
    Route::post('/prosesImport', 'importSiswa')->name('import_siswa')->middleware('auth');
});
Route::controller(GuruController::class)->group(function () {
    Route::get('/dataguru', 'index')->name('dataguru')->middleware('auth');
    Route::post('/insert_guru', 'tambah_guru')->name('insert_guru')->middleware('auth');
    Route::put('/dataguru/update/{id}', 'edit_guru')->middleware('auth')->middleware('auth');
    Route::delete('/dataguru/delete/{id}', 'delete')->name('delete_guru')->middleware('auth');
    ROute::get('showGuru/{id}', 'showguru')->name('showguru')->middleware('auth');
    Route::post('/importguru', 'importGuru')->name('importGuru')->middleware('auth');
});
Route::controller(SemesterController::class)->group(function () {
    Route::get('/semester', 'index')->name('semester')->middleware('auth');
    Route::post('/insert_semester', 'insertSemester')->name('insert_semester')->middleware('auth');
    Route::put('/semester/update/{id}', 'updateSemester')->name('update_semester')->middleware('auth');
    Route::delete('/deletesemester/{id}', 'deleteSemester')->name('deleteSemester')->middleware('auth');
});
Route::controller(KelasController::class)->group(function () {
    Route::get('/kelas', 'index')->name('datakelas')->middleware('auth');
    Route::post('/insert_kelas', 'insertKelas')->name('insertKelas')->middleware('auth');
    Route::put('/kelas/update/{id}', 'updateKelas')->name('update_kelas')->middleware('auth');
    Route::delete('/deleteKelas/{id}', 'deleteKelas')->name('deleteKelas')->middleware('auth');
});

// Route::controller(DetailKelasController::class)->group(function () {
//     Route::get('/detail/kelas/{id_kelas}', 'index')->name('detailkelas')->middleware('auth');
//     // menampilkan siswa berdasarkan id kelasnya
//     // Route::get('/kelassiswa/{kelas}', 'kelaskatagori')->name('kelaskatagori');
//     Route::post('/insert/detail', 'insertdetail')->name('insertdetail')->middleware('auth');
// });

Route::get('/rombel', [RombelController::class, 'index'])->name('rombel');
Route::post('/rombel/add', [RombelController::class, 'addRombel'])->name('rombel.add');
Route::put('/rombel/edit/{id}', [RombelController::class, 'updtRombel'])->name('rombel.updt');
Route::delete('/rombel/delete/{id}', [RombelController::class, 'deleteRombel'])->name('rombel.delete');



Route::controller(AbsenController::class)->group(function () {
    Route::get('/absen', 'index')->name('absen')->middleware('auth');
    Route::get('/absenSiswa/{id}', 'absen')->name('kelola_absen')->middleware('auth');
    Route::post('simpan/{id}/{id_pertemuan}', 'SimpanAbsen')->name('simpanAbsen')->middleware('auth');
    Route::get('rekapAbsen/{id}', 'rekapAbsen')->name('rekapAbsen')->middleware('auth');
    Route::get('/rekap-absen/pdf/{id}', 'downloadRekapAbsenPDF')->name('rekapAbsen.pdf');
});


Route::controller(PertemuanController::class)->group(function () {
    Route::get('/jadwalPelajaran', 'index')->name('jadwal');
    Route::post('addPertemuan/', 'addPertemuan')->name('addjadwal')->middleware('auth');
    Route::put('updatePertemuan/{id}', 'updatePertemuan')->name('updatePertemuan')->middleware('auth');
    Route::delete('deletePertemuan/{id}', 'deletePertemuan')->name('deletePertemuan')->middleware('auth');
});



Route::get('/trx_rombel/{id}', [trxRombelController::class, 'index'])->name('trx_rombel')->middleware('auth');
Route::post('/trx_rombel/add/{id}', [trxRombelController::class, 'addPeserta'])->name('add_peserta');

Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');
Route::get('/nilai/kelas/{id}', [NilaiController::class, 'kelolaNilai'])->name('kelola_nilai');
Route::post('/nilai/add', [NilaiController::class, 'InputNilai'])->name('inputNilai');
Route::controller(BeritaController::class)->group(function () {
    Route::get('/berita', 'index')->name('berita');
    Route::post('/berita/insert', 'insertBerita')->name('insertBerita');
    Route::delete('/berita/delete/{id}', 'deleteBerita')->name('deleteBerita');
});
