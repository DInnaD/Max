<?php

namespace App\Policies;

use App\User;
use App\Vacancy;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class OrganizationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
        /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        if($user->role == 'admin' ||  $user->role == 'employer'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function indaxStats(User $user)
    {
        if($user->role == 'admin'){
            return true;
        }
        return false;
    }

    public function show(User $user)
    {
        if($user->role == 'employer'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function store(User $user, Organization $model)
    {
        if($user->role == 'employer'){
            return $organization->id > 0;
        }
    }

    /** 
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, Organization $organization, Vacancy $model)
    {
        if($user->role == 'employer'){
        
            return $organization->id == $vacancy->organization_id;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, Organization $organization, Vacancy $model)
    {
        
        if($user->role == 'employer'){
        
            return $organization->id == $vacancy->organization_id;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
