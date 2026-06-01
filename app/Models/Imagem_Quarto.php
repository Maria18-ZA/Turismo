<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagem_Quarto extends Model
{
    protected $table = 'imagens_quartos';

    protected $fillable = [
        'quarto_id',
        'imagem',
        'is_principal'
    ];

    public function quarto() {
        return $this->belongsTo(Quarto::class);
    }

     public function imagemPrincipal()
{
    return $this->hasOne(Imagem_Hotel::class)->where('is_principal', true);
}
}
