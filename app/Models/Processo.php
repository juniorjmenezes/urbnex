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
        'empresa_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }

    public function requerentes()
    {
        return $this->belongsToMany(Requerente::class, 'processo_requerente')
                    ->withTimestamps();
    }

    public function andamentos()
    {
        return $this->hasMany(Andamento::class);
    }

    public function ultimoAndamento()
    {
        return $this->hasOne(Andamento::class)->latestOfMany();
    }
}