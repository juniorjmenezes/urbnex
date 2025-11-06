<?php

namespace App\Models\Urbnex;

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