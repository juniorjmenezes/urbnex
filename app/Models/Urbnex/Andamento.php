<?php

namespace App\Models\Urbnex;

use Illuminate\Database\Eloquent\Model;

class Andamento extends Model
{
    protected $fillable = [
        'data',
        'status',
        'complemento',
        'processo_id',
        'user_id',
    ];

    public function processo()
    {
        return $this->belongsTo(Processo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}