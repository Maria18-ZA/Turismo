<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Quarto;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    protected $table = 'hoteis';

    protected $fillable = [
        'hotel_id',
        'nome',
        'localizacao',
        'descricao',
        'contato',
    ];

   public function servicos(): HasMany
    {
        return $this->hasMany(Servico::class, 'hotel_id');
    }

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(Avaliacao::class, 'hotel_id');
    }

    public function quartos(): HasMany
    {
        return $this->hasMany(Quarto::class, 'hotel_id');
    }
    public function pontosTuristicos(): HasMany
    {
        return $this->belongsToMany(PontoTuristico::class, 'hoteis_pontos_turisticos', 'hotel_id', 'pontoturistico_id');
    }
    public function imagens(): HasMany
    {
        return $this->hasMany(Imagem_Hotel::class, 'hotel_id');
    }

}
