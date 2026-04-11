<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cultura extends Model
{
    protected $table = 'culturas';

    protected $fillable = [
        'nome', 
        'tipo',
        'descricao', 
        'localizacao',
        'data_celebracao',
        'foto_capa',
        'origem_etnica'
        ];

    public function imagens(): HasMany
    {
        return $this->hasMany(Imagem_Cultura::class, 'cultura_id');

    }
}

            