<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    protected $table = 'pessoas_juridicas';

    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
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
        return $this->hasOne(Requerente::class, 'pessoa_juridica_id');
    }

    // Relacionamento com processos (pivot pj_processo)
    public function processos()
    {
        return $this->belongsToMany(Processo::class, 'pj_processo', 'pessoa_juridica_id', 'processo_id')->withPivot('papel')->withTimestamps();
    }
}