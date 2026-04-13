<?php

namespace App\Policies;
use App\Models\User;
use App\Models\Quarto;

class QuartoPolicy
{
    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Quarto $quarto)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->role === 'admin' || $user->role === 'gestor';
    }

    public function update(User $user, Quarto $quarto)
    {
        return $user->role === 'admin' || $user->role === 'gestor';
    }

    public function delete(User $user, Quarto $quarto)
    {
        return $user->role === 'admin' || $user->role === 'gestor';
    }
}