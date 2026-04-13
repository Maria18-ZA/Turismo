<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cultura;

class CulturaPolicy
{
    public function viewAny(?User $user)
    {
        return true; // público pode ver
    }

    public function view(?User $user, Cultura $cultura)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Cultura $cultura)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Cultura $cultura)
    {
        return $user->role === 'admin';
    }
}