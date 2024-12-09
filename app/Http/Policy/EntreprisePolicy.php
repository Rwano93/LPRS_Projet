<?php

namespace App\Policies;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntreprisePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Entreprise $entreprise)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Entreprise $entreprise)
    {
        return $user->id === $entreprise->created_by || $user->role->libelle === 'Gestionnaire';
    }

    public function delete(User $user, Entreprise $entreprise)
    {
        return $user->id === $entreprise->created_by || $user->role->libelle === 'Gestionnaire';
    }

    public function verifyLink(User $user, Entreprise $entreprise)
    {
        return $user->id === $entreprise->created_by || $user->role->libelle === 'Gestionnaire';
    }
    public function approvePartnership(User $user, Entreprise $entreprise)
{
    return $user->role->libelle === 'Gestionnaire' || $user->id === $entreprise->created_by;
}

    public function rejectPartnership(User $user, Entreprise $entreprise)
    {
        return $user->role->libelle === 'Gestionnaire' || $user->id === $entreprise->created_by;
    }
}

