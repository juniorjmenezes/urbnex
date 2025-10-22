<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $table = 'pessoas_fisicas';

    protected $fillable = [
        'nome',
        'genero',
        'pais_origem',
        'nacionalidade',
        'cpf_cin',
        'rg',
        'rne_crnm',
        'cnh',
        'passaporte',
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