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
        'telefone_1',
        'telefone_2',
        'endereco_id',
    ];

    // Endereço associado à Pessoa Jurídica.
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    // Caso a Pessoa Jurídica seja um Requerente.
    public function requerente()
    {
        return $this->hasOne(Requerente::class, 'pessoa_juridica_id');
    }

    // Processos nos quais a Pessoa Jurídica participa
    public function processos()
    {
        return $this->belongsToMany(Processo::class, 'pj_processo', 'pessoa_juridica_id', 'processo_id')->withPivot('papel')->withTimestamps();
    }

    // Registro de Credenciamento (caso exista).
    public function credenciada()
    {
        return $this->hasOne(Credenciada::class);
    }

    // Retorna se a Pessoa Jurídica é Credenciada.
    public function getIsCredenciadaAttribute(): bool
    {
        return $this->credenciada()->exists();
    }
}