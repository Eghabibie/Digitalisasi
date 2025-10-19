<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\GoogleAuthController;

Route::get('/', [PinjamController::class, 'create'])->name('pinjam.create');
Route::post('/', [PinjamController::class, 'store'])
    ->name('pinjam.store')
    ->middleware('throttle:5,1');
Route::get('/export/bahan-padat', [ExportController::class, 'exportBahanPadat']);
Route::get('/export/bahan-cairan-lama', [ExportController::class, 'exportBahanCairanLama']);
Route::get('/test-error', function() {
    abort(500, 'Test Error');
});
// Rute untuk redirect ke Google
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
// Rute untuk callback dari Google
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');
// Rute untuk logout
Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('logout');