<?php

use App\Http\Controllers\AsesmenController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\FormController;
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

Route::get('/', [Controller::class, 'dasboard']);
// master data
Route::get('/pasien', [MasterDataController::class, 'getPasien']);
Route::post("/pasien", [MasterDataController::class, 'newPasien']);
Route::get('/obat', [MasterDataController::class, 'getObat']);
Route::get('/pesanan-obat', [MasterDataController::class, 'getPesananObat']);

// tab asesmen
Route::get('/antrian_asesmen', [AsesmenController::class, 'getAsesmenPage']);
Route::post('/asesmen', [AsesmenController::class, 'tambahAsesmen']);

// tab pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'getPendaftaran']);
Route::post('/pendaftaran', [PendaftaranController::class, 'newPendaftaran']);

// forms
Route::get('/tambah_pasien', [FormController::class, 'getFormTambahPasien']);
Route::get('/isi_asesmen', [FormController::class, 'getIsiAsesmenPage']);
