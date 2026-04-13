<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PontoTuristico;

class PontoTuristicoPolicy
{
    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, PontoTuristico $ponto)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, PontoTuristico $ponto)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, PontoTuristico $ponto)
    {
        return $user->role === 'admin';
    }
}
