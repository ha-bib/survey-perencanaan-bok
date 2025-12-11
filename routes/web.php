<?php

use App\Http\Controllers\UsulanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UsulanController::class, 'index'])->name('usulan.index');
Route::get('/indikator', [UsulanController::class, 'indikator'])->name('usulan.indikator');
Route::post('/user', [UsulanController::class, 'storeUser'])->name('usulan.storeUser');
Route::post('/usulan', [UsulanController::class, 'store'])->name('usulan.store');
Route::delete('/usulan/{id}', [UsulanController::class, 'destroy'])->name('usulan.destroy');
Route::post('/usulan/cancel', [UsulanController::class, 'cancel'])->name('usulan.cancel');
Route::get('/rekap', [UsulanController::class, 'rekap'])->name('usulan.rekap');