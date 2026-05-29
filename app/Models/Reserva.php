<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Quarto;
use App\Models\Hotel;

class Reserva extends Model
{
    protected $fillable = [
        'user_id',
        'nome_user',
        'contato',
        'email',
        'tipo_reserva',
        'checkin',
        'checkout',
        'preco_total',
        'status'
    ];

    protected $appends = ['google_maps_link'];

    /*
    |--------------------------------------------------------------------------
    | RELAÇÕES
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quartos()
    {
        return $this->belongsToMany(Quarto::class, 'reserva_quartos')
            ->withPivot('quantidade', 'preco');
    }

    /*
    |--------------------------------------------------------------------------
    | HOTEL (VERSÃO CORRIGIDA - PERFORMANCE)
    |--------------------------------------------------------------------------
    */

    public function hotel()
    {
        // evita queries repetidas no accessor
        return $this->hasOneThrough(
            Hotel::class,
            Quarto::class,
            'hotel_id', // FK em quartos
            'id',
            null,
            'hotel_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR OTIMIZADO
    |--------------------------------------------------------------------------
    */

    public function getHotelAttribute()
    {
        return $this->quartos->first()?->hotel;
    }

    /*
    |--------------------------------------------------------------------------
    | GOOGLE MAPS LINK
    |--------------------------------------------------------------------------
    */

    public function getGoogleMapsLinkAttribute()
    {
        $hotel = $this->hotel;

        if ($hotel && $hotel->latitude && $hotel->longitude) {
            return "https://www.google.com/maps/dir/?api=1&destination={$hotel->latitude},{$hotel->longitude}";
        }

        return null;
    }
}