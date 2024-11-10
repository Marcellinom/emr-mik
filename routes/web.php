<?php

use App\Http\Controllers\AsesmenController;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\FormController;
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
Route::get('/login', [UserController::class, 'getLoginPage'])->name('login');
Route::post('/login', [UserController::class, 'attemptLogin']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [Controller::class, 'dashboard']);
});
// master data
Route::get('/pasien', [MasterDataController::class, 'getPasien']);
Route::post("/pasien", [MasterDataController::class, 'newPasien']);
Route::get('/obat', [MasterDataController::class, 'getObat']);
Route::get('/pesanan-obat', [MasterDataController::class, 'getPesananObat']);

// tab pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'getPendaftaran']);
Route::post('/pendaftaran', [PendaftaranController::class, 'newPendaftaran']);

// tab asesmen
Route::get('/antrian_asesmen', [AsesmenController::class, 'getAsesmenPage']);
Route::get('/asesmen', [AsesmenController::class, 'invokeAsesmen']);
Route::post('/asesmen', [AsesmenController::class, 'tambahAsesmen']);

// tab pemeriksaan
Route::get('/antrian_pemeriksaan', [PemeriksaanController::class, 'getAntrianPemeriksaanPage']);
Route::get('/pemeriksaan', [PemeriksaanController::class, 'invokePemeriksaan']);
Route::prefix('pemeriksaan')->group(function () {
    Route::get('/asesmen_awal/{id}', [PemeriksaanController::class, 'dataAsesmenAwal']);
    Route::get('/soape/{id}', [PemeriksaanController::class, 'getSoape']);
    Route::get('/penunjang/{id}', [PemeriksaanController::class, 'getPenunjang']);
    Route::get('/resume_medis/{id}', [PemeriksaanController::class, 'getResumeMedis']);
});

Route::get('/konseling', [KonselingController::class, 'getKonselingPage']);
Route::post('/konseling', [KonselingController::class, 'newKonseling']);

// forms
Route::get('/tambah_pasien', [FormController::class, 'getFormTambahPasien']);
Route::get('/isi_asesmen', [FormController::class, 'getIsiAsesmenPage']);
