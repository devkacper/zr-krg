<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Currencies objects.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->roles->contains('name', 'admin');
    }

    /**
     * Determine whether the user can view specified the Currency object.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->roles->contains('name', 'admin');
    }

    /**
     * Determine whether the user can create the Currency object.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->roles->contains('name', 'admin');
    }
}
