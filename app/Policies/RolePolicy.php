<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class RolePolicy
{


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return in_array($user->role->id, [2]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role->id, [2]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        return in_array($user->role->id, [2]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return in_array($user->role->id, [2]);
    }

    public function deleteAny(User $user): bool
    {
        return in_array($user->role->id, [2]);
    }
}
