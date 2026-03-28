<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    protected $table = 'hoteis';

    protected $fillable = [
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
}
