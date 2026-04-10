<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagem_Pontosturistico extends Model
{
    protected $table = 'imagens_pontosturisticos';
    
    protected $fillable = [
        'pontoturistico_id',
        'imagem'
    ];

    public function pontoturistico() {
        return $this->belongsTo(PontoTuristico::class);
    }

}
