<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Imagem_Cultura;

class Cultura extends Model
{
    protected $table = 'culturas';

    protected $fillable = [
        'nome', 
        'tipo',
        'descicao', 
        'localizacao',
        'data_celebracao',
        'foto_capa',
        'origem_etnica'
        ];

  public function imagens(): HasMany
    {
        // Opção 1: Se a classe se chama ImagemCultura
        return $this->hasMany(Imagem_Cultura::class, 'cultura_id');
        
        // Opção 2: Se a classe se chama Imagem_Cultura (como no seu código)
        // return $this->hasMany(Imagem_Cultura::class, 'cultura_id');
    }
}

            