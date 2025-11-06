<?php

namespace App\Http\Controllers\Urbnex;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProcessoController extends Controller
{
    public function index()
    {
        return view('urbnex.processos.index');
    }

    public function create()
    {
        return view('urbnex.processos.create');
    }
}
