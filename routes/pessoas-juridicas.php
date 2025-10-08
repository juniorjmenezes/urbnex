<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaJuridicaController;

Route::get('/pessoas-juridicas', [PessoaJuridicaController::class, 'index'])->name('pessoas-juridicas.index');
Route::get('/pessoas-juridicas/create', [PessoaJuridicaController::class, 'create'])->name('pessoas-juridicas.create');
Route::post('/pessoas-juridicas', [PessoaJuridicaController::class, 'store'])->name('pessoas-juridicas.store');
Route::get('/pessoas-juridicas/{pessoaJuridica}/edit', [PessoaJuridicaController::class, 'edit'])->name('pessoas-juridicas.edit');
Route::put('/pessoas-juridicas/{pessoaJuridica}', [PessoaJuridicaController::class, 'update'])->name('pessoas-juridicas.update');
Route::delete('/pessoas-juridicas/{pessoaJuridica}', [PessoaJuridicaController::class, 'destroy'])->name('pessoas-juridicas.destroy');