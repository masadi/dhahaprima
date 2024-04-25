<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\CetakController;
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
Route::get('/', [PageController::class, 'index']);
Route::get('/cetak', [CetakController::class, 'generate_pdf']);
Route::post('/register', [MitraController::class, 'register']);
Route::group(['prefix' => 'p'], function () {
    Route::get('/{slug}', [PageController::class, 'pages']);
});
Route::get('/{any}', [ApplicationController::class, 'index'])->where('any', '.*');