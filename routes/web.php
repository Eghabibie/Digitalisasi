<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PinjamController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/export/bahan-padat', [ExportController::class, 'exportBahanPadat']);
Route::get('/export/bahan-cairan-lama', [ExportController::class, 'exportBahanCairanLama']);
Route::get('/pinjam', [PinjamController::class, 'create'])->name('pinjam.create');
Route::post('/pinjam', [PinjamController::class, 'store'])->name('pinjam.store');
