<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    protected $fillable = [
        'numero',
        'data_abertura',
        'observacoes',
        'imovel_id',
        'pessoa_juridica_id',
        'user_id',
    ];

    // Usuário que cadastrou o processo
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Pessoa Jurídica responsável pelo processo
    public function pessoaJuridica()
    {
        return $this->belongsTo(PessoaJuridica::class);
    }

    // Imóvel associado ao processo
    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }

    // Requerentes (PF ou PJ) associados ao processo
    public function requerentes()
    {
        return $this->belongsToMany(Requerente::class, 'processo_requerente')->withTimestamps();
    }

    // PJs participantes (credenciadas ou requerentes)
    public function pjs()
    {
        return $this->belongsToMany(PessoaJuridica::class, 'pj_processo')->withPivot('papel')->withTimestamps();
    }

    // Andamentos do processo
    public function andamentos()
    {
        return $this->hasMany(Andamento::class);
    }

    // Último andamento
    public function ultimoAndamento()
    {
        return $this->hasOne(Andamento::class)->latestOfMany();
    }
}