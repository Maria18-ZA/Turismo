<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaCriadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;
     public $googleMapsLink;
     public $hotel;

    public function __construct($reserva, $googleMapsLink = null, $hotel = null)
    {
        $this->reserva = $reserva;
        $this->googleMapsLink = $googleMapsLink;
         $this->hotel = $hotel;
    }

    public function build()
    {
        return $this->subject('Reserva Confirmada ')
                    ->view('emails.reserva');
    }
}