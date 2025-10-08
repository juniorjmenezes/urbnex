<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    protected $fillable = [
        'nucleo_urbano',
        'quadra',
        'matricula',
        'data_prenotacao',
        'lote',
        'area',
        'area_edificada',
        'perimetro',
        'latitude',
        'longitude',
        'art',
        'endereco_id',
    ];

    // Processo associado (um-para-um)
    public function processo()
    {
        return $this->hasOne(Processo::class);
    }

    // Endereço do imóvel
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }
}