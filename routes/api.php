<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaFisicaController;

Route::get('/pessoas-fisicas', [PessoaFisicaController::class, 'getPessoas']);
