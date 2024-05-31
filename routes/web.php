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
use App\Http\Controllers\SanksiController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TataTertibController;
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
Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->name('dashboard');

Route::get('/profile', function () {
    return view('backend.profile');
})->name('profile');

Route::controller(AuthController::class)->group(function () {
    Route::get('DataUser', 'index')->name('datauser');
    Route::get('/login', 'login')->name('login');
    Route::post('prosesLogin', 'proseslogin')->name('proseslogin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::controller(PelajaranController::class)->group(function () {
    Route::get('/mapel', 'index')->name('mapel');
    Route::post('/mapel/insert', 'ADDmapel')->name('mapelinsert');
    Route::put('/mapel/update/{id}', 'UPDmapel')->name('updatemapel');
});
Route::controller(SiswaController::class)->group(function () {
    Route::get('/allsiswa', 'allsiswa')->name('allsiswa');
    Route::get('/datasiswa', 'index')->name('datasiswa');
    Route::post('/datasiswa/insert_siswa', 'tambahSiswa')->name('insert_siswa');
    Route::put('/datasiswa/update/{id}', 'editsiswa')->name('update_siswa');
    Route::delete('/datasiswa/delete/{id}', 'deletesiswa')->name('delete_siswa');
    Route::post('/prosesImport', 'importSiswa')->name('import_siswa');
});
Route::controller(GuruController::class)->group(function () {
    Route::get('/dataguru', 'index')->name('dataguru');
    Route::post('/insert_guru', 'tambah_guru')->name('insert_guru');
    Route::put('/dataguru/update/{id}', 'edit_guru');
    Route::delete('/dataguru/delete/{id}', 'delete')->name('delete_guru');
    Route::post('/importguru', 'importGuru')->name('importGuru');
});
Route::controller(SemesterController::class)->group(function () {
    Route::get('/semester', 'index')->name('semester');
    Route::post('/insert_semester', 'insertSemester')->name('insert_semester');
    Route::put('/semester/update/{id}', 'updateSemester')->name('update_semester');
});
Route::controller(KelasController::class)->group(function () {
    Route::get('/kelas', 'index')->name('datakelas');
    Route::post('/insert_kelas', 'insertKelas')->name('insertKelas');
    Route::put('/kelas/update/{id}', 'updateKelas')->name('update_kelas');
});

Route::controller(DetailKelasController::class)->group(function () {
    Route::get('/detail/kelas/{id_kelas}', 'index')->name('detailkelas');
    // menampilkan siswa berdasarkan id kelasnya
    // Route::get('/kelassiswa/{kelas}', 'kelaskatagori')->name('kelaskatagori');
    Route::post('/insert/detail', 'insertdetail')->name('insertdetail');
});
Route::controller(PelanggaranController::class)->group(function () {
    Route::get('/pelanggaran', 'index')->name('pelanggaran');
});
Route::controller(TataTertibController::class)->group(function () {
    Route::get('/tataTertib', 'index')->name('tataTertib');
});
Route::controller(SanksiController::class)->group(function () {
    Route::get('/sanksi', 'index')->name('sanksi');
});
Route::controller(KelasPelajaranController::class)->group(function () {
    Route::get('/rombel', 'index')->name('rombel');
    Route::get('/getGuru/{id}', 'getGuru');
    Route::post('/insertRombel', 'tambahK_pelajaran')->name('insertRombel');
    Route::put('/rombel/update/{$id}', 'update')->name('updateRombel');
});
Route::get('/nilai/{$id}', [NilaiController::class, 'index'])->name('nilai');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::post('/berita/insert', [BeritaController::class, 'insertBerita'])->name('insertberita');

Route::controller(AbsenController::class)->group(function () {
    Route::get('/absen', 'index')->name('absen');
    Route::get('ambilGuru/{id}', 'getGuru');
    Route::get('/absen/kelas/{id_kelas}', 'kelasAbsen')->name('kelola_absen');
    Route::post('/insertAbsen', 'addAbsen')->name('tambahAbsen');
});
Route::controller(PertemuanController::class)->group(function () {
    Route::get('kelolaAbsen', 'index')->name('pertemuan');
});
