<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Quarto;

class Hotel extends Model
{

    protected $table = 'hoteis';
     protected $fillable = [
        'nome',
        'localizacao',
        'descricao',
        'contato',
        'latitude',
        'longitude',
    ];

    public function servicos(): HasMany
    {
        return $this->hasMany(Servico::class);
    }

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function quartos(): HasMany
    {
        return $this->hasMany(Quarto::class);
    }

    public function pontosTuristicos(): BelongsToMany
    {
        return $this->belongsToMany(
            PontoTuristico::class,
            'hoteis_pontos_turisticos',
            'hotel_id',
            'pontoturistico_id'
        );
    }

    public function imagens(): HasMany
    {
        return $this->hasMany(Imagem_Hotel::class);
    }

    protected static function booted()
    {
        static::deleting(function ($hotel) {
    $hotel->servicos()->delete();
    $hotel->imagens()->delete();
    $hotel->quartos->each(function ($quarto) {
    $quarto->imagens()->delete();
    $quarto->delete();
});
    $hotel->avaliacoes()->delete();
        });
    }
}