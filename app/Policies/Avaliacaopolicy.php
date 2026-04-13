<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Avaliacao;

class AvaliacaoPolicy
{
    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Avaliacao $avaliacao)
    {
        return true;
    }

    public function create(User $user)
    {
        return true; // qualquer usuário logado pode avaliar
    }

    public function update(User $user, Avaliacao $avaliacao)
    {
        return $user->id === $avaliacao->user_id;
    }

    public function delete(User $user, Avaliacao $avaliacao)
    {
        return $user->id === $avaliacao->user_id || $user->is_admin;
    }
}