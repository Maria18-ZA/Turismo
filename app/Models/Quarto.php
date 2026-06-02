<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    protected $table = 'quartos';

    protected $fillable = [
        'hotel_id',
        'numero',
        'tipo',
        'preco',
        'descricao',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function imagens()
    {
        return $this->hasMany(Imagem_Quarto::class);
    }

    public function imagemPrincipal()
    {
        return $this->hasOne(Imagem_Quarto::class)->where('is_principal', true);
    }
}