<?php

namespace App\Policies;

use App\Models\Child;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChildPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user === null) {
            return false;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Child $child)
    {
        if ($user->hasPermissionTo('child.list-all')) {
            return true;
        }

        if ($user->hasPermissionTo('child.list-my')) {
            return $user->children->contains($child->id);
        }

        return false;
    }
    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo('child.create')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Child $child)
    {
        if ($user->hasAllPermissions('child.list-all','child.update')) {
            return true;
        }

        if ($user->hasAllPermissions('child.list-my','child.update')) {
            return $user->children->contains($child->id);
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Child $child)
    {
        if ($user->hasAllPermissions(['child.list-all', 'child.delete'])) {
            return true;
        }
        if ($user->hasAllPermissions(['child.list-my', 'child.delete'])) {
            return $user->children->contains($child->id);
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Child $child)
    {
        if ($user->hasAllPermissions(['child.list-all', 'child.delete', 'child.create'])) {
            return true;
        }
        if ($user->hasAllPermissions(['child.list-my', 'child.delete', 'child.create'])) {
            return $user->children->contains($child->id);
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Child $child)
    {
        if ($user->hasAllPermissions(['child.list-all', 'child.delete'])) {
            return true;
        }
        if ($user->hasAllPermissions(['child.list-my', 'child.delete'])) {
            return $user->children->contains($child->id);
        }

        return false;
    }
}
