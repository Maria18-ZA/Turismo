<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Hotel;

class HotelPolicy
{
    public function viewAny(?User $user)
    {
        return true; // qualquer um pode ver
    }

    public function view(?User $user, Hotel $hotel)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user-> role === 'admin' || $user->role === 'gestor';
    }

    public function update(User $user, Hotel $hotel)
    {
        return $user->role === 'admin' || $user->role === 'gestor';
    }

    public function delete(User $user, Hotel $hotel)
    {
        return $user->role === 'admin' || $user->role === 'gestor';
    }
}
