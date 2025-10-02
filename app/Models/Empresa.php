<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'endereco',
        'bairro',
        'cep',
        'cidade',
        'estado',
    ];

    public function processos()
    {
        return $this->hasMany(Processo::class);
    }

    public function representantes()
    {
        return $this->hasMany(Representante::class);
    }
}