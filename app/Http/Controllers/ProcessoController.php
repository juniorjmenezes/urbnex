<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcessoController extends Controller
{
    public function index()
    {
        return view('processos.index');
    }

    public function create()
    {
        return view('processos.create');
    }
}
