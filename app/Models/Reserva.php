<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {

    protected $fillable = [
        'user_id',
        'nome_user',
        'contato',
        'email',
        //'quarto_id',
        'tipo_reserva',
        'checkin',
        'checkout',
        'preco_total',
        'status'
    ];

    protected $appends = ['google_maps_link']; // Adiciona ao JSON automaticamente

public function getGoogleMapsLinkAttribute()
{
    // Pega o primeiro quarto da reserva e seu hotel
    $quarto = $this->quartos()->with('hotel')->first();
    
    if ($quarto && $quarto->hotel && $quarto->hotel->latitude && $quarto->hotel->longitude) {
        $lat = $quarto->hotel->latitude;
        $lng = $quarto->hotel->longitude;
        
        // Opção 1: Link simples (abre no mapa centralizado)
        //return "https://www.google.com/maps?q={$lat},{$lng}";
        
        // Opção 2: Link com zoom e marcador (mais completo)
        // return "https://www.google.com/maps/@{$lat},{$lng},15z";
        
        // Opção 3: Link para navegação (já traça rota)
         return "https://www.google.com/maps/dir/?api=1&destination={$lat},{$lng}";
    }
    
    return null;
}


    public function user() {
        return $this->belongsTo(User::class);
    }

    //public function quarto() {
      //  return $this->belongsTo(Quarto::class);
    //}

    public function quartos()
{
    return $this->belongsToMany(Quarto::class, 'reserva_quartos')
                ->withPivot('quantidade', 'preco');
}

}