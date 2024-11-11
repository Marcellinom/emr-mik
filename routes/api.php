<?php

use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/pasien_by_name", [MasterDataController::class, 'getPasienByName']);
Route::get('/pasien_by_id_registrasi', [MasterDataController::class, 'getPasienByIdRegistrasi']);
Route::get("/dokter_by_name", [MasterDataController::class, 'getDokterByName']);
Route::get('/obat_by_name', [MasterDataController::class, 'getObatByName']);
Route::delete('/riwayat', [PendaftaranController::class, 'hapusRiwayat']);
