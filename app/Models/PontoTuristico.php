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
        'categoria',
        'descricao',
        'contato',
        
    ];

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(Avaliacao::class, 'pontoturistico_id');
    }
    public function hoteis(): HasMany
    {
        return $this->belongsToMany(Hotel::class, 'hoteis_pontos_turisticos', 'pontoturistico_id', 'hotel_id');
    }
}
