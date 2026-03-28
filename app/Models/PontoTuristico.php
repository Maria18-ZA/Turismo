<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PontoTuristico extends Model
{
    protected $table = 'pontos_turisticos';

     protected $fillable = [
        'nome',
        'localizacao',
        'tipo',
        'descricao',
    ];

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(Avaliacao::class, 'pontoturistico_id');
    }
}
