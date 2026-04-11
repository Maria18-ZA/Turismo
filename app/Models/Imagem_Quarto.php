<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagem_Quarto extends Model
{
    protected $table = 'imagens_quartos';

    protected $fillable = [
        'quarto_id',
        'imagem'
    ];

    public function quarto() {
        return $this->belongsTo(Quarto::class);
    }
}
