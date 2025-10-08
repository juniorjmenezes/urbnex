<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessoController;

Route::get('/processos', [ProcessoController::class, 'index'])->name('processos.index');
Route::get('/processos/create', [ProcessoController::class, 'create'])->name('processos.create');
Route::post('/processos', [ProcessoController::class, 'store'])->name('processos.store');
Route::get('/processos/{processo}/edit', [ProcessoController::class, 'edit'])->name('processos.edit');
Route::put('/processos/{processo}', [ProcessoController::class, 'update'])->name('processos.update');
Route::delete('/processos/{processo}', [ProcessoController::class, 'destroy'])->name('processos.destroy');