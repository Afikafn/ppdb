<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalKegiatanController;
use App\Http\Controllers\jurusanController;
use App\Http\Controllers\LogAkunController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('regist', [UserController::class, 'insertRegis'])->name('regist');
/**
 * socialite auth
 */
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);
    

Route::group(['middleware' => ['auth']], function () {
// Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

                                                                                   
    //akun
    Route::get('/profile', [LogAkunController::class, 'dataprofil'])->name("profile");
    Route::post('/edit-profile', [LogAkunController::class, 'editprofil'])->name('edit-profile');
    Route::post('/edit-pw', [LogAkunController::class, 'editakun']);

    //user/pengguna
    Route::get('/data-user', [UserController::class, 'datauser'])->name('data-user');
    Route::post('/save-user', [UserController::class, 'simpanuser']);
    Route::get('/edit-user/{user_id}', [UserController::class, 'edituser'])->name('edit-user');
    Route::put('/update-user/{user_id}', [UserController::class, 'updateuser'])->name('update-user');
    Route::delete('/delete-user/{user_id}', [UserController::class, 'hapususer'])->name('delete-user');

    //sekolah
    Route::get('/data-sekolah', [SekolahController::class, 'datasekolah'])->name('data-sekolah');
    Route::post('/save-school', [SekolahController::class, 'simpansekolah']);
    Route::put('/update-school/{npsn}', [SekolahController::class, 'updatesekolah']);
    Route::delete('/delete-school/{npsn}', [SekolahController::class, 'hapussekolah']);

    //jurusan
    Route::get('/data-jurusan', [JurusanController::class, 'datajurusan'])->name('data-jurusan');
    Route::post('/save-jurusan', [JurusanController::class, 'simpanjurusan'])->name('save-jurusan');
    Route::post('/update-jurusan/{id_jurusan}', [JurusanController::class, 'updatejurusan']);
    Route::delete('/delete-jurusan/{id_jurusan}', [JurusanController::class, 'hapusjurusan'])->name('delete-jurusan');

    //jadwal
    Route::get('/data-jadwal', [JadwalKegiatanController::class, 'datajadwal'])->name('data-jadwal');
    Route::post('/save-jadwal', [JadwalKegiatanController::class, 'simpanjadwal']);
    Route::put('/update-jadwal/{id}', [JadwalKegiatanController::class, 'updatejadwal']);
    Route::delete('/delete-jadwal/{id}', [JadwalKegiatanController::class, 'hapusjadwal']);

    //pendaftaran
    Route::get('/data-registration', [PendaftaranController::class, 'datapendaftaran'])->name('data-registration');
    Route::get('/form-registration', [PendaftaranController::class, 'inputpendaftaran']);
    Route::post('/save-registration', [PendaftaranController::class, 'simpanpendaftaran']);
    Route::get('/edit-registration/{id_pendaftaran}', [PendaftaranController::class, 'editpendaftaran']);
    Route::post('/update-registration/{id_pendaftaran}', [PendaftaranController::class, 'updatependaftaran']);
    //Route::get('/delete-registration/{id_pendaftaran}', [PendaftaranController::class, 'hapuspendaftaran']);
    Route::delete('/delete-registration/{id_pendaftaran}', [PendaftaranController::class, 'hapuspendaftaran'])->name('delete-registration');
    Route::get('/detail-registration/{id_pendaftaran}', [PendaftaranController::class, 'detailpendaftaran']);
    Route::get('/card-registration/{id_pendaftaran}', [PendaftaranController::class, 'kartupendaftaran']);

    Route::get('/verified-registration/{id_pendaftaran}', [PendaftaranController::class, 'verifikasistatuspendaftaran']);
    Route::get('/notverified-registration/{id_pendaftaran}', [PendaftaranController::class, 'notverifikasistatuspendaftaran']);
    Route::get('/invalid-registration/{id_pendaftaran}', [PendaftaranController::class, 'invalidstatuspendaftaran']);
    Route::get('/finish-registration/{id_pendaftaran}', [PendaftaranController::class, 'selesaistatuspendaftaran']);

    //pengumuman
    Route::get('/data-announcement', [PengumumanController::class, 'datapengumuman'])->name('data-pengumuman');
    Route::get('/view-announcement/{id_pendaftaran}', [PengumumanController::class, 'lihatpengumuman']);
    //Route::get('/view-announcement', [PengumumanController::class, 'lihatpengumuman']);
    //Route::post('/save-announcement', [PengumumanController::class, 'simpanpengumuman'])->name('save-pengumuman');
    Route::put('/update-announcement/{id_pengumuman}', [PengumumanController::class, 'updatepengumuman']);
    Route::delete('/delete-announcement/{id_pengumuman}', [PengumumanController::class, 'hapuspengumuman']);

});

require __DIR__.'/auth.php';