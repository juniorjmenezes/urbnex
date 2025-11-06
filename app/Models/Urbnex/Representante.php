<?php

namespace App\Models\Urbnex;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'estado_civil',
        'endereco_id',
        'pessoa_juridica_id',
    ];

    public function pessoaJuridica()
    {
        return $this->belongsTo(PessoaJuridica::class);
    }
}