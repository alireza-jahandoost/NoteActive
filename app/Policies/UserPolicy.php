<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('view-users-other');
    }

    public function viewByRole(User $user)
    {
        return ($user->hasPermission('view-users-other') && $user->hasPermission('view-roles'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if ($user->id === $model->id && $user->hasPermission('edit-user-self')) {
            return true;
        }else if($user->hasPermission('edit-user-other')) return true;
        return false;
    }
    public function changePassword(User $user , User $model)
    {
        if ($user->id === $model->id && $user->hasPermission('change-password-self')) {
            return true;
        }else if($user->hasPermission('change-password-other')) return true;
        return false;
    }

    public function updateRole(User $user , User $model)
    {
        //users can't change their role themselves
        return ($user->hasPermission('change-user-role') && $user->id !== $model->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        if ($user->id === $model->id) {
            //dont let users delete their acconut
            return false;
        }else if($user->hasPermission('delete-user-other')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }

}
