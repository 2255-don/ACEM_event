<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function superAdminAccess(User $user)
    {
       return $user->profil->libelle === 'Super-admin';
    }

    public function adminAccess(User $user)
    {
        return in_array($user->profil->libelle, ['Admin','Super-admin']);
    }

    public function allAccess(User $user)
    {
        return in_array($user->profil->libelle, ['Employer', 'Admin','Super-admin']);
    }
}
