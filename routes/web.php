<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/export/bahan-padat', [ExportController::class, 'exportBahanPadat']);
Route::get('/export/bahan-cairan-lama', [ExportController::class, 'exportBahanCairanLama']);