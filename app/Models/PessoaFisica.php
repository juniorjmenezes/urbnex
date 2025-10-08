<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    protected $table = 'pessoas_fisicas';

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'estado_civil',
        'profissao',
        'email',
        'telefone',
        'endereco_id',
    ];

    // Relacionamento com endereço
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    // Relacionamento com requerente
    public function requerente()
    {
        return $this->hasOne(Requerente::class, 'pessoa_fisica_id');
    }
}