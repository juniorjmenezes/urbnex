<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaJuridicaController;
use App\Http\Controllers\CredenciamentoController;

Route::get('/pessoas-juridicas', [PessoaJuridicaController::class, 'index'])->name('pessoasJuridicas.index');
Route::get('/pessoas-juridicas/create', [PessoaJuridicaController::class, 'create'])->name('pessoasJuridicas.create');
Route::post('/pessoas-juridicas', [PessoaJuridicaController::class, 'store'])->name('pessoasJuridicas.store');
Route::get('/pessoas-juridicas/{pessoaJuridica}/edit', [PessoaJuridicaController::class, 'edit'])->name('pessoasJuridicas.edit');
Route::put('/pessoas-juridicas/{pessoaJuridica}', [PessoaJuridicaController::class, 'update'])->name('pessoasJuridicas.update');
Route::delete('/pessoas-juridicas/{pessoaJuridica}', [PessoaJuridicaController::class, 'destroy'])->name('pessoasJuridicas.destroy');