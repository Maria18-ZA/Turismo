<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {

    protected $fillable = [
        'user_id',
        'quarto_id',
        'checkin',
        'checkout'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function quarto() {
        return $this->belongsTo(Quarto::class);
    }
}