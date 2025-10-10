<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }

    public function requerente()
    {
        return $this->belongsTo(Requerente::class);
    }

    public function representante()
    {
        return $this->belongsTo(Representante::class);
    }
}