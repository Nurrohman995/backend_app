<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\HistoryTransaksiController;

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

Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class,'getBarang']);
    Route::post('/postBarang', [BarangController::class,'postBarang']);
});

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class,'getKategori']);
    Route::post('/post', [KategoriController::class,'post']);
    Route::get('/delete', [KategoriController::class,'delete']);
    Route::post('/update', [KategoriController::class,'update']);
});

Route::prefix('history_transaksi')->group(function () {
    Route::get('/', [HistoryTransaksiController::class,'getTransaksi']);
    Route::post('/post', [HistoryTransaksiController::class,'postData']);
});
