<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Urbnex\ProcessoController;
use App\Http\Controllers\PessoaJuridicaController;
use App\Http\Controllers\PessoaFisicaController;

Route::prefix('urbnex')->name('urbnex.')->group(function () {

    // Processos REURB
    Route::get('/processos', [ProcessoController::class, 'index'])->name('processos.index');
    Route::get('/processos/create', [ProcessoController::class, 'create'])->name('processos.create');
    Route::post('/processos', [ProcessoController::class, 'store'])->name('processos.store');
    Route::get('/processos/{processo}/edit', [ProcessoController::class, 'edit'])->name('processos.edit');
    Route::put('/processos/{processo}', [ProcessoController::class, 'update'])->name('processos.update');
    Route::delete('/processos/{processo}', [ProcessoController::class, 'destroy'])->name('processos.destroy');

    // Pessoas Jurídicas
    Route::get('/pessoas-juridicas', [PessoaJuridicaController::class, 'index'])->name('pessoasJuridicas.index');
    Route::get('/pessoas-juridicas/create', [PessoaJuridicaController::class, 'create'])->name('pessoasJuridicas.create');
    Route::post('/pessoas-juridicas', [PessoaJuridicaController::class, 'store'])->name('pessoasJuridicas.store');
    Route::get('/pessoas-juridicas/{pessoaJuridica}/edit', [PessoaJuridicaController::class, 'edit'])->name('pessoasJuridicas.edit');
    Route::put('/pessoas-juridicas/{pessoaJuridica}', [PessoaJuridicaController::class, 'update'])->name('pessoasJuridicas.update');
    Route::delete('/pessoas-juridicas/{pessoaJuridica}', [PessoaJuridicaController::class, 'destroy'])->name('pessoasJuridicas.destroy');

    // Pessoas Físicas
    Route::get('/pessoas-fisicas', [PessoaFisicaController::class, 'index'])->name('pessoasFisicas.index');
    Route::get('/pessoas-fisicas/create', [PessoaFisicaController::class, 'create'])->name('pessoasFisicas.create');
    Route::post('/pessoas-fisicas', [PessoaFisicaController::class, 'store'])->name('pessoasFisicas.store');
    Route::get('/pessoas-fisicas/{pessoaFisica}/edit', [PessoaFisicaController::class, 'edit'])->name('pessoasFisicas.edit');
    Route::put('/pessoas-fisicas/{pessoaFisica}', [PessoaFisicaController::class, 'update'])->name('pessoasFisicas.update');
    Route::delete('/pessoas-fisicas/{pessoaFisica}', [PessoaFisicaController::class, 'destroy'])->name('pessoasFisicas.destroy');

    // Endpoints Pessoas Físicas
    Route::get('/pessoas-fisicas/data', [PessoaFisicaController::class, 'getData'])->name('pessoasFisicas.data');
});

