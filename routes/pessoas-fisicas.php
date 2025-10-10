<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaFisicaController;

Route::get('/pessoas-fisicas', [PessoaFisicaController::class, 'index'])->name('pessoasFisicas.index');
Route::get('/pessoas-fisicas/create', [PessoaFisicaController::class, 'create'])->name('pessoasFisicas.create');
Route::post('/pessoas-fisicas', [PessoaFisicaController::class, 'store'])->name('pessoasFisicas.store');
Route::get('/pessoas-fisicas/{pessoaFisica}/edit', [PessoaFisicaController::class, 'edit'])->name('pessoasFisicas.edit');
Route::put('/pessoas-fisicas/{pessoaFisica}', [PessoaFisicaController::class, 'update'])->name('pessoasFisicas.update');
Route::delete('/pessoas-fisicas/{pessoaFisica}', [PessoaFisicaController::class, 'destroy'])->name('pessoasFisicas.destroy');