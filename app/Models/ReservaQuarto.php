<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservaQuarto extends Model
{
      protected $fillable = [
        'reserva_id',
        'quarto_id',
        'quantidade',
        'preco'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function quarto()
    {
        return $this->belongsTo(Quarto::class);
    }

}
