<?php

use App\Http\Controllers\Api\ChartOfAccountController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('kategori',[KategoriController::class,'index']);
Route::post('kategori',[KategoriController::class,'store']);
Route::get('kategori/{id}',[KategoriController::class,'show']);
Route::put('kategori/{id}',[KategoriController::class,'update']);
Route::delete('kategori/{id}',[KategoriController::class,'destroy']);

Route::get('coa',[ChartOfAccountController::class,'index']);
Route::post('coa',[ChartOfAccountController::class,'store']);
Route::get('coa/{id}',[ChartOfAccountController::class,'show']);
Route::put('coa/{id}',[ChartOfAccountController::class,'update']);
Route::delete('coa/{id}',[ChartOfAccountController::class,'destroy']);

Route::get('transaksi',[TransaksiController::class,'index']);
Route::post('transaksi',[TransaksiController::class,'store']);
Route::get('transaksi/{id}',[TransaksiController::class,'show']);
Route::delete('transaksi/{id}',[TransaksiController::class,'destroy']);

Route::get('laporan',[LaporanController::class,'laporan']);
