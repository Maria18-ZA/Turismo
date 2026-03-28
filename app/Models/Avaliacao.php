<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';

    protected $fillable = [
        'user_id',
        'hotel_id',
        'pontoturistico_id',
        'nota',
        'comentario',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function pontoTuristico(): BelongsTo
    {
        return $this->belongsTo(PontoTuristico::class, 'pontoturistico_id');
    }
}
