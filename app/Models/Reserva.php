<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {

    protected $fillable = [
        'user_id',
        'nome_user',
        'quarto_id',
        'tipo_reserva',
        'checkin',
        'checkout',
        'preco_total',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function quarto() {
        return $this->belongsTo(Quarto::class);
    }

    public function quartos()
{
    return $this->belongsToMany(Quarto::class, 'reserva_quartos')
                ->withPivot('quantidade', 'preco');
}

}