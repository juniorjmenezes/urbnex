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
        'art',
        'endereco',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'processo_id'
    ];

    public function processo()
    {
        return $this->belongsTo(Processo::class);
    }
}