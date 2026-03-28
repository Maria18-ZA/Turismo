<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Servico extends Model
{
    protected $table = 'servicos';

    protected $fillable = [
        'hotel_id',
        'nome',
        'descricao',
        'tipo',
    ];


    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}