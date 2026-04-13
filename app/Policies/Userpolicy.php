<?php

namespace App\Policies;

use App\Models\User;

class Userpolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
{
    return true; // qualquer usuário pode ver
}

public function create(User $user)
{
    return true; // pode criar (ex: reserva)
}

public function update(User $user, User $model)
{
    return $user->id === $model->id;
}

public function delete(User $user, User $model)
{
    return $user->id === $model->id;
}
}
