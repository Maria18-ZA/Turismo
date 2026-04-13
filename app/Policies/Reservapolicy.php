<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reserva;

class ReservaPolicy
{
    public function viewAny(User $user)
    {
        return true; // usuário vê suas reservas
    }

    public function view(User $user, Reserva $reserva)
    {
        return $user->id === $reserva->user_id || $user->role === 'admin' || $user->role === 'gestor'; 
    }

    public function create(User $user)
    {
        return true; // qualquer usuário logado pode reservar
    }

    public function delete(User $user, Reserva $reserva)
    {
        return $user->id === $reserva->user_id || $user->role === 'admin' || $user->role === 'gestor';
    }
}