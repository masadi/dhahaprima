<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MitraController;
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
Route::get('no-access', [PageController::class, 'no_access'])->name('login');
Route::post('webhook', [PageController::class, 'webhook']);
Route::get('/detil-mitra/{id}', [MitraController::class, 'detil']);
Route::post('/filter-mitra', [MitraController::class, 'filter']);
Route::group(['prefix' => 'wilayah'], function () {
  Route::post('/provinsi', [MitraController::class, 'provinsi']);
  Route::post('/kabupaten', [MitraController::class, 'kabupaten']);
  Route::post('/kecamatan', [MitraController::class, 'kecamatan']);
  Route::post('/desa', [MitraController::class, 'desa']);
});
Route::group(['prefix' => 'auth'], function () {
  Route::get('/semester', [AuthController::class, 'semester']);
  Route::post('login', [AuthController::class, 'login']);
  Route::post('register', [AuthController::class, 'register']);
  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
  });
});
Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [PageController::class, 'list_data']);
    Route::post('/store', [PageController::class, 'store']);
    Route::post('/destroy', [PageController::class, 'destroy']);
  });
  Route::group(['prefix' => 'mitra'], function () {
    Route::get('/', [MitraController::class, 'list_data']);
    Route::post('/store', [MitraController::class, 'store']);
    Route::post('/destroy', [MitraController::class, 'destroy']);
    Route::post('/provinsi', [MitraController::class, 'provinsi']);
    Route::post('/kabupaten', [MitraController::class, 'kabupaten']);
    Route::post('/kecamatan', [MitraController::class, 'kecamatan']);
    Route::post('/desa', [MitraController::class, 'desa']);
    Route::post('/approve', [MitraController::class, 'approve']);
    Route::post('/decline', [MitraController::class, 'decline']);
  });
  Route::group(['prefix' => 'users'], function () {
    Route::get('/profil', [AuthController::class, 'profil']);
    Route::post('/update-profile', [AuthController::class, 'update_profile']);
  });
});
