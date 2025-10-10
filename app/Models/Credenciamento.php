<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credenciamento extends Model
{
    protected $fillable = [
        'data_credenciamento',
        'validade',
        'situacao',
        'observacoes',
        'pessoa_juridica_id'
    ];

    // Relação com Pessoa Jurídica
    public function pessoaJuridica()
    {
        return $this->belongsTo(PessoaJuridica::class);
    }
}