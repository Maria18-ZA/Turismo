<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;
use App\Models\Reserva;

class Quarto extends Model {

      protected $table = 'quartos';
      
    protected $fillable = [
        'hotel_id',
        'numero',
        'tipo',
        'preco'

    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }

    public function reservas() {
        return $this->hasMany(Reserva::class);
    }

    public function imagens() {
        return $this->hasMany(Imagem_Quarto::class);
    }

}
