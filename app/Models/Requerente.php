<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requerente extends Model
{
    protected $fillable = [
        'tipo',        // PF ou PJ
        'nome',        // Nome ou Razão Social
        'cpf_cnpj',    // CPF ou CNPJ
        'email',
        'telefone',
        'endereco',
        'bairro',
        'cep',
        'cidade',
        'estado',
    ];

    public function processos()
    {
        return $this->belongsToMany(Processo::class, 'processo_requerente')
                    ->withTimestamps();
    }
}